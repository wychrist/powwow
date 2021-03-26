import { Controler } from "./Controller";
import { Request, Response } from "express";
import { getRepository } from "typeorm";
import { Application } from '../entity/Application'
import { generateRadom } from '../type/api'

export class AdminController extends Controler {
    private adminToken = '';
    private appRepository = getRepository(Application)
    constructor() {
        super()
        this.adminToken = this.getSetting('admin_token', 'random' + Date.now())
    }

    async getApplications(request: Request, response: Response): Promise<Application[]> {
        return new Promise((resolve, _) => {
            this.isBearerEqual(request, this.adminToken, (isValid: boolean) => {
                if (isValid) {
                    resolve(this.appRepository.find())
                } else {
                    this.returnInvalidToken(response)
                }
            })
        })
    }

    async createApplication(request: Request, response: Response): Promise<Application> {
        return new Promise(async (resolve, _) => {
            this.isBearerEqual(request, this.adminToken, async (isValid: boolean) => {
                if (isValid) {

                    let app = new Application()
                    try {
                        const clean = this.validate(request.body)
                        for (let name in clean) {
                            app[name] = clean[name]
                        }
                        app.status = 'active';
                        app.secret = generateRadom();
                        app.key = generateRadom();
                        resolve(this.appRepository.save(app));

                    } catch (error) {
                        response.status(400).end(error.message)
                    }

                } else {
                    this.returnInvalidToken(response)
                }
            })
        })
    }

    private validate(data: object): object {
        let rule = {
            name: (val: string) => {
                return (val.trim()) ? true : 'application name is requried';
            },
            domain: (val: string) => {
                return (val && val.indexOf('http') == 0) ? true : 'valid domain is required'
            }
        }
        let clean = {}
        for (let name in rule) {
            if (data[name]) {
                let result = rule[name](data[name])
                if (typeof result === 'boolean') {
                    clean[name] = data[name]
                } else {
                    throw Error(result)
                }
            } else {
                let result = rule[name]('')
                if (typeof result === 'boolean') {
                    clean[name] = ''
                } else {
                    throw Error(result);
                }
            }
        }

        return clean
    }
}