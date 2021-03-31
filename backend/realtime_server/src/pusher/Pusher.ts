
import { Socket } from "socket.io";
import { ErrorCode } from "./ErrorCode";
import { createHmac } from 'crypto'

export class Pusher {


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

    public static generateClientChannelHashMac(secret: string, socketId: string, channelName: string, data: string = null): string {
        let signature = `${socketId}:${channelName}`;
        if (data) {
            data = JSON.stringify(JSON.parse(data));
            signature += `:${data}`
        }

        return createHmac('sha256', secret).update(signature).digest('hex').toString()
    }
}