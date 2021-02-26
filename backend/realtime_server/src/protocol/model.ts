interface IMessage {
    event: string,
    data: string
}


interface IConnectionEstablished {
    event: string,
    data: {
        socket_id: string,
        activity_timeout: number
    }
}

