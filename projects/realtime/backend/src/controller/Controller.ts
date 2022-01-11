import { Request, Response } from "express";
import { env } from "process";
import { getRepository } from "typeorm";
import { Setting } from '../entity/Setting'
import { getSettings } from '../settings'


export class Controler {

    private settings = getSettings()

    protected settingRepository = getRepository(Setting);

    protected getBearer(request: Request): string {
        return request.headers.authorization?.toString().replace('Bearer', '').trim();
    }

    protected ifBearer(request, callback: (token: string) => void): string {
        const token = this.getBearer(request);
        if (token && callback) {
            callback(token)
        }

        return token
    }
    protected isBearerEqual(request: Request, token: string, callback: (isValid: boolean) => void): boolean {
        let isValid = false
        if (this.getBearer(request) === token && callback) {
            isValid = true
        }
        callback(isValid)

        return isValid
    }

    protected getSetting(name: string, fallback: string = ''): string {
        switch (name) {
            case 'admin_token':
                fallback = env.CP_REALTIME_ADMIN_DEFAULT_TOKEN // fallback from .env
                break;
            default:
        }
        return this.settings[name] || fallback
    }

    protected returnInvalidToken(response: Response) {
        response.status(403).json(this.buildResponseMessage('token is invalid'))
    }

    protected return404(response: Response, message: string | object) {
        response.status(404).json(this.buildResponseMessage(message))
    }

    protected buildResponseMessage(message: string | object) {
        return {
            message
        }
    }

}