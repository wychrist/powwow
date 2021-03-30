import { Socket, io } from 'socket.io-client'
import { DefaultEventsMap } from 'socket.io-client/build/typed-events';
import { chatDomain } from '../socketio'
import { IConnection, ISetupOption } from './model';

type callback = (data: string) => void
class Connection implements IConnection {

  private eventMap: Map<string, callback[]>
  private lastEvent: string;
  private lastEventData: string
  private client: Socket | null

  constructor() {
    this.eventMap = new Map<string, callback[]>()
    this.lastEvent = ''
    this.lastEventData = ''
    this.client = null
  }

  bind(event: string, callback: (data: string) => void): IConnection {
    const existing = this.eventMap.get(event) || []

    this.eventMap.set(event, [...existing, callback])
    this.dispatch()

    return this;
  }

  connect(key: string, option: ISetupOption): IConnection {
    if (!this.client) {
      this.client = io(`${chatDomain}/${key}`, option)
      this.client.on('pusher:connection_established', (data: string) => {
        this.lastEvent = 'connected'
        this.lastEventData = data
        this.dispatch()
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

}


const connection = new Connection()

export function getInstance(appKey: string, option: ISetupOption): IConnection {
  return connection.connect(appKey, option)
}
