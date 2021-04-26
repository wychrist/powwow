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

export interface PusherSocket extends Socket {
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