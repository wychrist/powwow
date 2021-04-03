
import { Socket } from "socket.io";
import { ErrorCode } from "./ErrorCode";
import { createHmac } from 'crypto'
import { PusherSocket, IPresenceData } from "../type/Interfaces";
import { Application } from "../entity/Application";
import { getRepository, In } from "typeorm";
import { Channel } from "../entity/Channel";
import { Status } from "../type/status";
import { ChannelClient } from "../entity/ChannelClient";
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

    public static sendSubscriptionSeucced(socket: Socket, channel: string, data?: string) {
        socket.emit('pusher_internal:subscription_succeeded', JSON.stringify({
            channel,
            data: data
        }))
    }

    public static channelNeedsAuthenticating(channel: string): boolean {
        return (channel.indexOf('private-') === 0 || channel.indexOf('presence-') === 0)
    }

    public static addClientToChannel(socket: PusherSocket, app: Application, data: string): boolean {
        const payload = JSON.parse(data) as { channel: string, auth?: string, channel_data?: string }
        let result = false

        if (this.channelNeedsAuthenticating(payload.channel)) {
            const hash = app.key + ':' + this.generateClientChannelHashMac(app.secret, socket.id, payload.channel, payload.channel_data)
            if (hash == payload.auth) {
                socket.join(payload.channel)
                socket.to(payload.channel).emit(`${payload.channel}:testevent`, "Let's welcome socket to private room")
                socket._pusherChannels.add(payload.channel)
                socket.emit('pusher_internal:subscription_succeeded', JSON.stringify({ channel: payload.channel }))
                result = true
            } else {
                console.log('too bad')
                return false
            }
        } else {
            socket.join(payload.channel)
            socket.to(payload.channel).emit(`${payload.channel}:testevent`, "okay guys we are on a role")
            socket._pusherChannels.add(payload.channel)
            result = true
        }

        if (result) {
            //@todo notify other clients if this is a presence channel
        }

        return result
    }

    public static toPusherSocket(socket: PusherSocket): PusherSocket {
        socket._pusherChannels = new Set<string>();
        return socket
    }

    public static removeClientFromChannel(socket: PusherSocket, data: string): PusherSocket {
        const payload = JSON.parse(data) as { channel: string, auth?: string, channel_data?: string }

        // @todo notify the other clients?!!!?
        socket.leave(payload.channel)

        return socket
    }

    public static generateClientChannelHashMac(secret: string, socketId: string, channelName: string, data: string = null): string {
        let signature = `${socketId}:${channelName}`;
        if (data) {
            signature += `:${data}`
        }

        return createHmac('sha256', secret).update(signature).digest('hex').toString()
    }
}