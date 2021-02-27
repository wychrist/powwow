// import { IMessage } from "src/protocol/model";

export function addNumbers (number1: number, number2: number) {
    return number1 + number2
}

export class Server {

    public constructor () {
        console.log('created')
    }
    /*public constructor() {
        console.log('sever instance created')
    }*/

    /* public handleEvent(event: IMessage, socket: any) {
        switch (event.event) {
            case 'request_to_connect':
            this.handleConnectRequest(event, socket)
            break;
        }
    }

    public handleConnectRequest(event: IMessage, socket: any) {
        const data = JSON.parse(event.data)
        socket.emit('server_pusher_event', {
            event: 'pusher:connection_established',
            data: ""
        })
    } */
}
