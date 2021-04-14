import { getRepository } from "typeorm";
import { NextFunction, Request, Response } from "express";
import { Application } from '../entity/Application'
import { IApplication } from '../type/Interfaces'
import { Controler } from "./Controller";
import { Server, Socket } from "socket.io";
import { PusherApplication } from '../pusher/PusherApplication'

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

    trigger(req: Request, _: Response) {
        let app = this.apps[req.params.key]
        if (app) {
            // @todo parse payload
            let payload = req.body as { channel: string, event: string, data: string }
            if (payload.channel) {
                this.io.of(req.params.key)
                    .to(payload.channel)
                    .emit(payload.event, payload.data)
                return {
                    success: true
                }
            }

        }

        return {
            success: false
        }
    }
}