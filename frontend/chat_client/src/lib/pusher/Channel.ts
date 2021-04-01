import { Socket } from 'socket.io-client'
import { IChannel, ClientEventHandler } from './model'

export class Channel implements IChannel {

  private name: string;
  private client;
  private eventMap: Map<string, ClientEventHandler[]>;

  constructor(name: string, client: Socket | null) {
    this.name = name
    this.client = client;
    this.eventMap = new Map<string, ClientEventHandler[]>()

    this.client?.on('pusher_internal:subscription_succeeded', (data: string) => {
      const payload = JSON.parse(data) as { channel: string }
      if (payload.channel === this.name) {
        this.dispatch('succeeded', payload)
        console.log('subscribing was successful!!!!!')
      }
    })

  }

  trigger(event: string, data: string): IChannel {
    this.client?.emit(`client-${event}`, data);
    return this;
  }

  bind(event: string, callback: ClientEventHandler): IChannel {
    this.eventMap.set(event, [...this.eventMap.get(event) || [], callback])

    switch (event) {
      case 'succeeded':
        // do nothing
        break;
      default:
        this.client?.on(`${this.name}:${event}`, (data) => {
          this.trigger(event, data)
        });
    }

    return this;
  }
  unbind(event?: string, handler?: ClientEventHandler): IChannel {

    if (event && handler) {

    } else if (event && !handler) {

    } else if (!event && handler) {

    } else if (!event && !handler) {

    }

    return this;
  }

  private dispatch(event: string, data: unknown) {
    this.eventMap.get(event)?.forEach((callback) => {
      callback(data)
    })
  }
}
