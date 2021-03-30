import { Socket } from 'socket.io-client'
import { IChannel, EventHandler } from './model'

export class Channel implements IChannel {

  private name: string;
  private client;

  constructor(name: string, client: Socket | null) {
    this.name = name
    this.client = client;
  }

  trigger(event: string, data: string): IChannel {
    this.client?.emit(event, data);
    return this;
  }

  bind(event: string, callback: EventHandler): IChannel {
    this.client?.on(`${this.name}:${event}`, callback);
    return this;
  }
  unbind(event?: string, handler?: EventHandler): IChannel {

    if (event && handler) {

    } else if (event && !handler) {

    } else if (!event && handler) {

    } else if (!event && !handler) {

    }

    return this;
  }

}
