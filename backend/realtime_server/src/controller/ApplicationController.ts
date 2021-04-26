import { getRepository } from "typeorm";
import { NextFunction, Request, Response } from "express";
import { Application } from '../entity/Application'
import { IChannelEventPayload, IChannelEventResponse } from '../type/Interfaces'
import { Controler } from "./Controller";
import { Server, Socket } from "socket.io";
import { PusherApplication } from '../pusher/PusherApplication'
import { createHmac, createHash } from 'crypto'
import { Channel } from "../entity/Channel";
import { ChannelClient } from "../entity/ChannelClient";

export class ApplicationController extends Controler {
    private applicationRepo = getRepository(Application)
    private io: Server;
    private apps: { [key: string]: PusherApplication };

    constructor(io: Server, apps: { [key: string]: PusherApplication }) {
        super();
        this.io = io;
        this.apps = apps
    }

    async get(req: Request) {
        let app = this.apps[req.params.key]
        return [{
            name: app ? app.getApp() : req.params.key
        }];
    }

    batchTriggerEvent(req: Request, res: Response) {
        let payloads = req.body.batch as IChannelEventPayload[]
        let appId = req.params.id;
        let promises = []

        payloads.forEach((payload) => {
            promises.push(
                this.trigger(appId, payload)
            )
        })

        Promise.allSettled(promises)
            .then((result) => {
                const response = [];
                result.forEach((entry) => {
                    response.push(entry.status === 'fulfilled' ? entry.value : entry.reason)
                })
                res.json(response);
            });
    }

    triggerEvent(req: Request, res: Response) {
        let payload = req.body as IChannelEventPayload
        let appId = req.params.id;

        this.trigger(appId, payload)
            .then((result) => {
                res.json(result)
            })
            .catch((result) => {
                res.json(result)
            });

    }


    private trigger(id: string, payload: IChannelEventPayload): Promise<IChannelEventResponse> {
        return new Promise((resolve, reject) => {
            let { auth_key, auth_timestamp, auth_version, body_md5, auth_signature } = payload
            let appId = id
            let app = this.apps[auth_key] || false

            if (app && app.getApp().id == appId) {
                const validationResult = this.validate(
                    app,
                    auth_key,
                    auth_timestamp,
                    auth_version,
                    body_md5,
                    auth_signature,
                    payload
                );

                if (validationResult.success) {
                    const promises = []
                    const channelRepo = getRepository(Channel);
                    const channelClientRepo = getRepository(ChannelClient);
                    const result = {
                        success: true
                    };


                    payload.channels.forEach((channel) => {
                        if (payload.socket_id && this.io.of(auth_key).sockets.has(payload.socket_id)) {
                            this.io.of(auth_key).sockets.get(payload.socket_id)
                                .to(channel)
                                .emit(`${channel}:${payload.event}`, payload.data)
                        } else {
                            this.io.of(auth_key)
                                .to(channel)
                                .emit(`${channel}:${payload.event}`, payload.data)
                        }

                        const infoPromise = []
                        promises.push(new Promise((resolve, reject) => {
                            if (payload.info) {
                                const room = this.io.of(auth_key).to(channel)
                                result[channel] = {};
                                payload.info.split(',').forEach((info) => {
                                    switch (info.trim()) {
                                        case 'subscription_count':
                                            infoPromise.push(new Promise((resolve, reject) => {
                                                room.allSockets()
                                                    .then((sockets) => {
                                                        result[channel].subscription_count = sockets.size
                                                        resolve('success')
                                                    })
                                                    .catch((error) => {
                                                        result[channel].subscription_count = -1 // for now
                                                        reject(-1)
                                                    })
                                            }))
                                            break;
                                        case 'user_count':
                                            if (channel.indexOf('presence-') === 0) {
                                                infoPromise.push(new Promise((resolve, reject) => {
                                                    channelRepo.findOne({
                                                        where: {
                                                            name: channel,
                                                            application: appId
                                                        }
                                                    }).then((ch) => {
                                                        //@todo find a better way !?!!?
                                                        const rawSql = `select count(distinct(\`user_id\`)) as total from rt_channel_client  where channelId = '${ch.id}'`
                                                        channelClientRepo.query(rawSql)
                                                            .then((countResult) => {
                                                                result[channel].user_count = parseInt(countResult.pop().total, 10)
                                                                resolve('success')
                                                            })
                                                            .catch((error) => {
                                                                reject(-1)
                                                            })
                                                    }).catch((error) => {
                                                        result[channel].user_count = -1
                                                        reject(-1)
                                                    })

                                                }))
                                            }
                                            break;
                                    }
                                });

                                if (infoPromise.length) {
                                    Promise.allSettled(infoPromise)
                                        .then((all) => {
                                            resolve(result)
                                        })
                                        .catch(() => {
                                            resolve(result)
                                        });
                                } else {
                                    resolve(result)
                                }

                            } else {
                                resolve(result)
                            }
                        }));
                    })

                    Promise.allSettled(promises)
                        .then(() => {
                            resolve(result)
                        })
                        .catch(reject);
                } else {
                    reject(validationResult);
                }
            } else {
                reject({
                    success: false,
                    reason: 'application not found'
                });
            }
        });
    }

    private validate(
        app: PusherApplication,
        authKey: string,
        authTimestamp: string,
        authVersion: string,
        bodyMd5: string,
        authSignature: string,
        payload: IChannelEventPayload,
        method: string = 'POST'
    ): { success: boolean, reason: string } {

        let appKey = app.getApp().key;
        let appSecret = app.getApp().secret;
        let appTimestamp = Date.now()
        let result = {
            success: false,
            reason: ''
        };
        method = method.toUpperCase()

        if ((appTimestamp - parseInt(authTimestamp, 10)) > (600 * 1000)) {
            result.success = false;
            result.reason = 'timestamp expired';
            return result;
        }

        if (authKey !== appKey) {
            result.success = false;
            result.reason = 'application key does not match';
            return result;
        }


        const appMd5 = (payload.data) ? createHash('md5').update(payload.data).digest('hex').toString() : '';
        if (bodyMd5 !== appMd5) {
            result.success = false
            result.reason = 'body md5 has does not match';
            return result;
        }

        const str = `${method}\n/apps/${app.getApp().id}/events\nauth_key=${appKey}&auth_timestamp=${authTimestamp}&auth_version=${authVersion}&body_md5=${bodyMd5}`;
        const hash = createHmac('sha256', appSecret).update(str).digest('hex').toString();

        if (authSignature !== hash) {
            result.success = true;
            result.reason = 'auth signature does not match';
            return result;
        }

        result.success = true;
        result.reason = 'validation passed';

        return result;

    }
}