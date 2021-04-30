import { Socket } from "socket.io";

export interface IApplication {
    id?: number,
    name: string,
    server: string,
    status: string
}

export interface ValidationResult {
    success: boolean,
    message?: string
}

export interface IRoute {
    method: string,
    route: string,
    controller: Function,
    action: string
}

export interface ISettingEntry {
    [name: string]: string
}

export interface IPresenceData {
    user_id: string | number,
    user_info?: unknown
}

export interface IPowwowSocket {
    _powwow?: {
        user_id?: string | number
    }
}
export interface IPusherSocket extends Socket, IPowwowSocket {
    _pusherChannels?: Map<string, string>
}

export interface IChannelEventPayload {
    channels: string[],
    event: string,
    data?: string,
    socket_id?: string
    auth_key: string,
    auth_timestamp: string,
    auth_version: string,
    body_md5: string,
    auth_signature: string,
    info: string
}

export interface IChannelEventResponse {

}

export interface IChannelSubscribePayload {
    channel: string,
    auth?: string,
    channel_data?: string
}

export interface IWebhookClientEvent {
    channel: string,
    event: string,
    data: unknown,
    socket_id: string,
    user_id: string
}