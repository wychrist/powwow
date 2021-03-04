export interface IMessage {
    event: string,
    data: string
}


export interface IConnectionEstablished {
    event: string,
    data: {
        socket_id: string,
        activity_timeout: number
    }
}

