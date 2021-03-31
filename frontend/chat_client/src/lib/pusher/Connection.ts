import { Socket, io } from 'socket.io-client'
import { chatDomain } from '../socketio'
import { IConnection, ISetupOption } from './model';

type callback = (data: string) => void

interface IErrorData { code: number, message?: string }

class Connection implements IConnection {

  private eventMap: Map<string, callback[]>;
  private lastEvent: string;
  private lastEventData: string;
  private client: Socket | null;
  private appKey: string;
  private option: ISetupOption;
  private backOff: number;

  constructor() {
    this.eventMap = new Map<string, callback[]>()
    this.lastEvent = ''
    this.lastEventData = ''
    this.client = null
    this.backOff = 1000;
    this.appKey = ''
    this.option = {}
  }

  bind(event: string, callback: (data: string) => void): IConnection {
    const existing = this.eventMap.get(event) || []

    this.eventMap.set(event, [...existing, callback])
    this.dispatch()

    return this;
  }

  connect(key: string, option: ISetupOption): IConnection {
    this.appKey = key;
    this.option = option;

    if (!this.client) {
      this.client = io(`${chatDomain}/${key}`, option)
      this.client.on('pusher:connection_established', (data: string) => {
        this.lastEvent = 'connected'
        this.lastEventData = data
        this.dispatch()
        console.log('connection successful', data)
        /*const parsedData = JSON.parse(data) as { socket_id: string, acitivity_timeout: number }
         const watchForTimeout = () => {
          setTimeout(() => {
            this.client?.emit('pusher:ping')
            const handler = setTimeout(() => {
              console.log('server has not resonse to our ping')
            }, 30 * 1000);

            this.client?.on('pusher:pong', () => {
              if (handler) {
                 clearTimeout(handler)
                 console.log('we got back a pong!!')
               }
            })
            watchForTimeout()
          }, parsedData.acitivity_timeout * 1000 * 60)
        }
        watchForTimeout() */
      })

      this.client.on('pusher:error', (data: string) => {
        this.lastEvent = 'error'
        this.lastEventData = data
        this.dispatch()
        this.handleError(JSON.parse(data) as IErrorData)
      })
    }

    return this
  }

  getClient(): Socket | null {
    return this.client
  }

  private dispatch() {
    if (this.lastEvent) {
      this.eventMap.get(this.lastEvent)?.forEach((callback) => {
        callback(this.lastEventData ? JSON.parse(this.lastEventData) : null)
      })
      this.eventMap.delete(this.lastEvent)
    }
  }

  private handleError(data: IErrorData) {

    if (data.code >= 4000 && data.code <= 4099) { //4000-4099
      this.client?.close()
      console.log('connection close for good', data)
    } else if (data.code >= 4100 && data.code <= 4199) { //4100-4199

      console.log(`backing off for ${this.backOff / 1000} second(s)`);
      this.client?.close()

      setTimeout(() => {
        console.log('trying to reconnnect to server')
        this.client = null
        this.connect(this.appKey, this.option)
      }, this.backOff)
      this.backOff *= 2

    } else if (data.code >= 4200 && data.code <= 4299) { //4200-4299
      console.log('try reconnecting')
      this.client?.close()
      this.client = null
      this.connect(this.appKey, this.option)
    }
  }

}


const connection = new Connection()

export function getInstance(appKey: string, option: ISetupOption): IConnection {
  return connection.connect(appKey, option)
}
