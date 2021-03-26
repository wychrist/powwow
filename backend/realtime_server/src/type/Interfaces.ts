import { Controler } from "../controller/Controller";

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