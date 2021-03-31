
import { Socket } from "socket.io";
import { ErrorCode } from "./ErrorCode";

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

        if (code >= 4000 && code <= 4099) { //4000-4099
            socket.disconnect()
        } else if (code >= 4100 && code <= 4199) { //4100-4199
            socket.disconnect()
        } else if (code >= 4200 && code <= 4299) { //4200-4299
            socket.disconnect()
        }
    }
}