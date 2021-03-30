import axios from 'axios'
import { Channel } from './Channel'
import { IClient, ISetupOption, IChannel, EventHandler, IConnection } from './model'
import { getInstance } from './Connection'

export class Pusher implements IClient {

  private option;
  private appKey: string;

  public connection: IConnection;


  constructor(appKey: string, option: ISetupOption = {}) {
    this.option = option
    this.appKey = appKey

    this.connection = getInstance(this.appKey, this.option)
  }

  public getStatus(): boolean {
    return this.connection.getClient()?.active || false
  }

  trigger(event: string, data: string): IClient {
    this.connection.getClient()?.emit(`client-${event}`, data)
    return this;
  }

  channel(name: string): IChannel {
    if (name.indexOf('private-') == 0) {
      axios.post('/', this.option)
        .then(() => {
          // @todo
        })
        .catch(() => {
          // @todo
        })
      // get auth string
      this.connection.getClient()?.emit('pusher:subscribe', JSON.stringify({
        data: { channel: name, key: '' }
      }));
    } else if (name.indexOf('presence-') == 0) {
      // get auth string
      this.connection.getClient()?.emit('pusher:subscribe', JSON.stringify({
        data: { channel: name, key: '', 'channel data': '' }
      }));

    } else {
      this.connection.getClient()?.emit('pusher:subscribe', JSON.stringify({
        data: { channel: name }
      }));
    }
    return new Channel(name, this.connection.getClient());
  }
  allChannels(): IChannel[] {
    return []
  }
  subscribe(channel: string): IChannel {
    return this.channel(channel);
  }
  unsubscribe(channel: string): IClient {
    this.connection.getClient()?.emit('pusher::unsubscribe', JSON.stringify({
      data: {
        channel
      }
    }))
    return this;
  }
  bind(event: string, callback: EventHandler): IClient {
    this.connection.getClient()?.on(event, callback)
    return this;
  }
  unbind(event?: string, handler?: EventHandler): IClient {
    if (event && handler) {

    } else if (event && !handler) {

    } else if (!event && handler) {

    } else if (!event && !handler) {

    }

    return this;
  }

}

