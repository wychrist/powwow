import axios from 'axios'
import { Channel } from './Channel'
import { IClient, ISetupOption, IChannel, EventHandler, IConnection } from './model'
import { getInstance } from './Connection'

export class PusherClient implements IClient {

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

  channel(name: string, onError?: (reason: unknown) => void): IChannel {
    if (name.indexOf('private-') === 0  || name.indexOf('presence-') === 0) {
      // get auth string
      axios.post(this.option.authEndpoint as string,
        {
          socket_id: this.connection.getClient()?.id,
          channel_name: name
        })
        .then((result: { data: { auth: string, channel_data?: string } }) => {
          // @todo
          console.log('result from auth server', result.data)
          const data = Object.assign({ channel: name }, result.data)
          this.connection.getClient()?.emit('pusher:subscribe', JSON.stringify(data));

        })
        .catch((error) => {
          if (onError) {
              onError(error)
          }
            // @todo log the error
        })
    } else {
      this.connection.getClient()?.emit('pusher:subscribe', JSON.stringify({
        channel: name
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
    console.log('trying to unsubscribe....')
    this.connection.getClient()?.emit('pusher:unsubscribe', JSON.stringify({
      channel
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

