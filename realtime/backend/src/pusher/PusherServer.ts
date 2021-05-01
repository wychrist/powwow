
import { Socket } from "socket.io";
import { ErrorCode } from "./ErrorCode";
import { createHmac } from 'crypto'
import { IPusherSocket, IPresenceData, IChannelSubscribePayload } from "../type/Interfaces";
import { Application } from "../entity/Application";
import { getRepository, In } from "typeorm";
import { Channel } from "../entity/Channel";
import { Status } from "../type/status";
import { ChannelClient } from "../entity/ChannelClient";
import { Webhook } from './Webhook'
export class PusherServer {


    public static get errorCode() {
        return ErrorCode
    }

    /**
     * Sends a valid pusher error message to the spcificed client 
     * 
     * @param socket 
     * @param code 
     * @param message 
     * 
     */
    public static sendError(socket: Socket, code: number | { code: number, message: string }, message: string = null) {

        if (typeof code !== 'number') {
            message = message || code.message
            code = code.code
        }

        socket.emit('pusher:error', JSON.stringify({
            code,
            message
        }))

        if (code >= 4000 && code <= 4999) {
            socket.disconnect()
        }
    }

    public static sendSubscriptionSucceed(socket: Socket, channel: string, data?: string) {
        socket.emit('pusher_internal:subscription_succeeded', JSON.stringify({
            channel,
            data: data
        }))
    }

    public static channelNeedsAuthenticating(channel: string): boolean {
        return (channel.indexOf('private-') === 0 || channel.indexOf('presence-') === 0)
    }

    public static async addClientToChannel(socket: IPusherSocket, app: Application, data: string):
        Promise<{success: boolean, payload: IChannelSubscribePayload }> {
        return new Promise(async (resolve, reject) => {

            const payload = JSON.parse(data) as IChannelSubscribePayload
            const result = {
                success: false,
                payload
            } 

            let presenceData: IPresenceData = { user_id: socket.id, user_info: {} }

            if (this.channelNeedsAuthenticating(payload.channel)) {
                const hash = `${app.key}:${this.generateClientChannelHashMac(app.secret, socket.id, payload.channel, payload.channel_data)}`

                if (payload.channel_data) {
                    presenceData = Object.assign({ user_info: {} }, JSON.parse(payload.channel_data) as IPresenceData)
                }

                if (hash == payload.auth) {
                    console.log('authentication passed');
                    try {

                        const channelRepo = getRepository(Channel)
                        let channel = await channelRepo.findOne({ where: { name: payload.channel, application: app } });
                        if (!channel) {
                            channel = new Channel()
                            channel.application = app;
                            channel.name = payload.channel;
                            channel.status = Status.ACTIVE;
                            channel = await channelRepo.save(channel);

                            Webhook.publishChannelOccupied(channel.name, app);
                        }
                        

                        if (channel.status === Status.ACTIVE) {
                            //@todo check if channel limit has been reached

                            let client = new ChannelClient();

                            client.channel = channel;
                            client.clientId = socket.id;
                            client.userId = presenceData.user_id as string;
                            client.info = JSON.stringify(presenceData.user_info);

                            client = await getRepository(ChannelClient).save(client)

                            socket.join(payload.channel)
                            socket._pusherChannels.set(payload.channel, client.id)
                            socket._powwow.user_id = client.userId

                            socket.emit('pusher_internal:subscription_succeeded', JSON.stringify({ channel: payload.channel }))

                            result.success = true;
                        }
                        if (result && this.isPresenceChannel(payload.channel)) {
                            socket.to(payload.channel).emit('pusher_internal:member_added', JSON.stringify({
                                channel: payload.channel,
                                data: presenceData
                            }));
                            Webhook.publishChannelMemberAdded(payload.channel, presenceData.user_id as string, app)
                        }

                    } catch (error) {
                        this.sendError(socket, ErrorCode[4200].code, error.message);
                        reject(error)
                    }
                } else {
                    socket.emit('pusher_internal:subscription_failed', JSON.stringify({ channel: payload.channel }))
                    result.success = false;
                }
            } else {
                socket.join(payload.channel)
                socket._pusherChannels.set(payload.channel, '')
                result.success = true;
            }

            resolve(result)
        });
    }

    public static isPresenceChannel(name: string): boolean {
        return name.indexOf('presence-') === 0;
    }

    public static isPrivateChannel(name: string): boolean {
        return name.indexOf('private-') === 0;
    }

    public static toPusherSocket(socket: IPusherSocket): IPusherSocket {
        socket._pusherChannels = new Map<string, string>();
        socket._powwow = {
            user_id: ''
        }
        return socket;
    }

    public static removeClientFromChannel(socket: IPusherSocket, channelName: string, app: Application, channelClient?: ChannelClient): IPusherSocket {
        (async () => {
            if (!channelClient) {
                channelClient = await getRepository(ChannelClient).findOne({ where: { name: socket._pusherChannels.get(channelName) } });
            }
            if (this.isPresenceChannel(channelName)) {
                socket.to(channelName).emit('pusher_internal:member_removed', JSON.stringify({
                    channel: channelName,
                    data: {
                        user_id: channelClient.userId,
                        user_info: channelClient.info
                    }
                }));
                Webhook.publishChannelMemberRemoved(channelName, channelClient.userId, app)
            }
            socket.leave(channelName);
            getRepository(ChannelClient).delete(channelClient.id);
        })();

        return socket
    }

    public static cleanUp(socket: IPusherSocket, app: Application): IPusherSocket {
        const clientIds = []
        let entries = socket._pusherChannels.entries()

        do {
            const channel = entries.next();
            if (channel.done) {
                break;
            }

            if (channel.value[1]) {
                clientIds.push(channel.value[1]);
            }

        } while (true)

        // get the client data
        if (clientIds.length) {
            ; (async () => {
                let clientData = await getRepository(ChannelClient).find({ where: { id: In(clientIds) }, relations: ['channel'] })
                clientData.forEach((client) => {
                    this.removeClientFromChannel(socket, client.channel.name, app, client)
                })
            })();
        }

        return socket;
    }

    public static generateClientChannelHashMac(secret: string, socketId: string, channelName: string, data: string = null): string {
        let signature = `${socketId}:${channelName}`;
        if (data) {
            signature += `:${data}`;
        }

        return createHmac('sha256', secret).update(signature).digest('hex').toString();
    }
}