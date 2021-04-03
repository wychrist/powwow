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