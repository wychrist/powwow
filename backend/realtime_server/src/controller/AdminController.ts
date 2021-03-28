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

    async updateApplication(request: Request, response: Response): Promise<Application> {
        return new Promise(async (resolve, _) => {
            console.log('in....')
            this.isBearerEqual(request, this.adminToken, async (isValid: boolean) => {
                if (isValid) {
                    try {
                        let app = await this.appRepository.findOneOrFail(request.params.id)
                        const clean = this.validate(request.body, app)
                        for (let name in clean) {
                            app[name] = clean[name]
                        }
                        this.appRepository.save(app)
                        resolve(app)
                    } catch (error) {
                        response.status(400).end(error.message)
                    }
                } else {
                    this.returnInvalidToken(response)
                }
            })
        })
    }

    private validate(data: object, app: Application = null): object {
        let clean = {}
        const rule = {
            name: (val: string) => {
                if (val && val.trim()) {
                    clean['name'] = val
                } else if (!app || !app.id) {
                    throw Error('application name is requried')
                }
            },
            domain: (val: string) => {
                if (val && val.indexOf('http')) {
                    clean['domain'] = val
                } else if (!app || !app.id) {
                    throw Error('valid domain is required');
                }
            },
            status: (val: string = null) => {
                if (val && val.trim())  {
                    clean['status'] = val
                } else if (!app || !app.id) {
                    throw Error('status is required');
                }
            }
        }
        for (let name in rule) {
            rule[name](data[name] || undefined)
        }

        return clean
    }
}