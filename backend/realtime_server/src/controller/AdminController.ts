import { Controler } from "./Controller";
import { Request, Response } from "express";
import { getRepository, In } from "typeorm";
import { Application } from '../entity/Application'
import { generateRadom } from '../type/api'
import { ApplicationSetting } from "../entity/ApplicationSetting";

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

    async getAnApplication(request: Request, response: Response): Promise<Application> {
        return new Promise((resolve, reject) => {
            this.isBearerEqual(request, this.adminToken, async (isValid: boolean) => {
                if (isValid) {
                    try {
                        const app = await this.getApplication(request.params.id)
                        resolve(app)
                    } catch (error) {
                        this.return404(response, error.message)
                        reject(error)
                    }
                } else {
                    this.returnInvalidToken(response)
                    reject()
                }
            })
        });
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

                        this.appRepository.save(app);
                        app = await this.setApplicationSettings(app, request.body);
                        resolve(app);
                    } catch (error) {
                        response.status(400).json(this.buildResponseMessage(error.message))
                    }

                } else {
                    this.returnInvalidToken(response)
                }
            })
        })
    }

    async updateApplication(request: Request, response: Response): Promise<Application> {
        return new Promise(async (resolve, _) => {
            this.isBearerEqual(request, this.adminToken, async (isValid: boolean) => {
                if (isValid) {
                    try {
                        let app = await this.appRepository.findOneOrFail(request.params.id)
                        const clean = this.validate(request.body, app)
                        for (let name in clean) {
                            app[name] = clean[name]
                        }

                        app = await this.appRepository.save(app)
                        app = await this.setApplicationSettings(app, request.body)
                        resolve(app)
                    } catch (error) {
                        response.status(400).json(this.buildResponseMessage(error.message));
                    }
                } else {
                    this.returnInvalidToken(response)
                }
            })
        })
    }

    async deleteApplication(request: Request, response: Response): Promise<Application> {
        return new Promise(async (resolve, _) => {
            this.isBearerEqual(request, this.adminToken, async (isValid: boolean) => {
                if (isValid) {
                    try {
                        let app = await this.appRepository.findOneOrFail(request.params.id)
                        this.appRepository.softDelete(app.id);
                        resolve(app);
                    } catch (error) {
                        this.return404(response, error.message);
                    }
                } else {
                    this.returnInvalidToken(response)
                }
            });
        });
    }

    async restoreApplication(request: Request, response: Response): Promise<Application> {
        return new Promise(async (resolve, _) => {
            this.isBearerEqual(request, this.adminToken, async (isValid: boolean) => {
                if (isValid) {
                    try {
                        const result = await this.appRepository.restore(request.params.id);
                        const app = await this.appRepository.findOneOrFail(result.affected);
                        resolve(app);
                    } catch (error) {
                        response.status(404).json({ message: error.message })
                    }

                } else {
                    this.returnInvalidToken(response);
                }
            });
        });
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
                if (val && val.indexOf('http') !== -1) {
                    clean['domain'] = val
                } else if (!app || !app.id) {
                    throw Error('valid domain is required');
                }
            },
            status: (val: string = null) => {
                if (val && val.trim()) {
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

    private setApplicationSettings(app: Application, data: { settings?: { name: string, value: string }[] }): Promise<Application> {
        return new Promise((resolve, reject) => {
            if (data.settings) {
                let names = data.settings.map((setting) => setting.name);
                getRepository(ApplicationSetting).find({ where: { application: app, name: In(names) } })
                    .then((result) => {
                        let builtSettings = {}
                        data.settings.forEach((settingData) => {
                            if (settingData.name) {
                                builtSettings[settingData.name] = new ApplicationSetting();
                                builtSettings[settingData.name].application = app;
                                builtSettings[settingData.name].name = settingData.name;
                                builtSettings[settingData.name].value = settingData.value;
                            }
                        })

                        result.forEach((setting) => {
                            if (builtSettings[setting.name]) {
                                let value = builtSettings[setting.name].value;
                                builtSettings[setting.name] = setting
                                builtSettings[setting.name].value = value
                            }
                        });

                        getRepository(ApplicationSetting).save(Object.values(builtSettings))
                            .then(() => {
                                this.getApplication(app.id)
                                    .then((app) => {
                                        resolve(app)
                                    })
                                    .catch(reject)
                            })
                            .catch(reject)

                    })
                    .catch(reject)
            } else {
                this.getApplication(app.id)
                    .then(resolve).catch(reject)
            }
        });
    }

    private getApplication(id: string, include: string[] = ['settings']): Promise<Application> {
        return new Promise<Application>((resolve, reject) => {
            this.appRepository.findOneOrFail(id, { relations: include })
                .then(resolve).catch(reject);

        });
    }
}