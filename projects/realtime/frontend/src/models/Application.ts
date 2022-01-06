import { LocalStorage } from 'quasar'

export interface IApplication {
  id: string,
  name: string,
  domain: string,
  key: string,
  secret: string
}

export const Model = {
  all(): Array<IApplication> {
    let list = Array<IApplication>()

    if (LocalStorage.has('applications')) {
      list = LocalStorage.getItem('applications') as IApplication[]
    }

    return list
  },
  getById(id: string): IApplication | null {
    const applications = this.all()
    let app: IApplication | null = null

    for (let i = 0; i < applications.length; i++) {
      if (id.trim() == applications[i].id.trim()) {
        app = applications[i]
        break;
      }
    }

    return app
  },
  save(app: IApplication): IApplication {
    const applications = (LocalStorage.has('applications')) ? LocalStorage.getItem('applications') as IApplication[] : []
    applications.push(app)
    LocalStorage.set('applications', applications)

    return app
  }
}

export class Application implements IApplication {
  name: string
  id: string
  domain: string
  key: string
  secret: string

  constructor() {
    this.name = ''
    this.id = ''
    this.domain = ''
    this.key = ''
    this.secret = ''
  }
}
