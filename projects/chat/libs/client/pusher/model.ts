
import { Socket } from 'socket.io-client'
export interface IMessage {
  event: string,
  data: string
}

export interface ISetupOption {
  authEndpoint?: string,
  cluster?: string,
  forceTLS?: boolean,
  authTransport?: string,
  auth?: {
    params: { [key: string]: string },
    headers: { [Key: string]: string }
  },
  authorizer?: (channel: string, options: { [key: string]: string }) => { authorize: (socketId: string, callback: (auth: { auth: string }) => void) => void }
}

export interface IConnection {
  bind(event: string, callback: (data: string) => void): IConnection
  getClient(): Socket | null
}


export interface IClient {
  /**
   * Emits an event
   *
   * @param {string} event
   * @param {sring} data
   *
   * @return {IClient}
   */
  trigger(event: string, data: string): IClient

  /**
   * Subscribe to a channel
   *
   * @param string name
   *
   * @return {IChannel}
   */
  channel(name: string): IChannel

  /**
   * Get all subscribed channels
   *
   * @return {IChannel[]}
   */
  allChannels(): IChannel[]

  /**
   * Subscribe to a channel
   *
   * @param {string} channel
   */
  subscribe(channel: string): IChannel

  /**
   * Unsubscribe to a channel
   *
   * @param {string} channel
   *
   * @return {IClient}
   */
  unsubscribe(channel: string): IClient

  /**
   * Register a handler for a cleint event
   *
   * @param {string} event
   * @param {Function} callback
   *
   * @return {IClient}
   */
  bind(event: string, callback: EventHandler): IClient

  /**
   * Unregister a event handler on the client
   *
   * @param {string} event
   * @param {Function} handler
   *
   * @return {IClient}
   */
  unbind(event?: string, handler?: EventHandler): IClient
}

export type EventHandler = (data: string, meta?: string) => void

export type ClientEventHandler = (data: unknown) => void

export interface IChannel {

  /**
   * Register an event handler for an event
   *
   * @param {string} event
   * @param {Function} callback
   *
   * @return {IChannel}
   */
  bind(event: string, callback: ClientEventHandler): IChannel

  /**
   * Unregister an event handler
   *
   * @param {string} event
   * @param {Function} handler
   *
   * @return {IChannel}
   */
  unbind(event?: string, handler?: ClientEventHandler): IChannel

  /**
   * Emits an event
   *
   * @param {string} event
   * @param {sring} data
   *
   * @return {IClient}
   */
  trigger(event: string, data: string): IChannel
}
