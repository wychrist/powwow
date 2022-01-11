
import { Namespace, Socket } from "socket.io";
import { Application } from "../entity/Application";
import { PusherServer } from "./PusherServer";
import { IPusherSocket } from '../type/Interfaces'
import { Webhook } from "./Webhook";

export class PusherApplication {

  private ns: Namespace;
  private app: Application;

  constructor(ns: Namespace, app: Application) {
    this.ns = ns;
    this.app = app;
  }

  authenticate(socket: IPusherSocket) {
    console.log(`socket connected on ${this.app.name}`, socket.id)

    this.doConnectionAuth(socket); // wait for a specified timeout and see if the client has joined a private room
    this.acceptConnection(socket);
    this.registerEventHandlers(socket);

  }


  getApp(): Application {
    return this.app
  }

  acceptConnection(socket: Socket) {
    socket.emit('pusher:connection_established', JSON.stringify({
      socket_id: socket.id,
      activitiy_timeout: 120
    }))
    console.log("we got a new connection: " + socket.id);
  }

  private registerEventHandlers(socket: IPusherSocket) {
    // handle client disconnet event
    socket.on('disconnect', (reason) => {
      console.log('client disconnected', reason);
    });

    // Handle client disconnecting event
    socket.on('disconnecting', (reason) => {
      PusherServer.cleanUp(socket, this.app);
      console.log('client disconnecting', reason);
    });

    // handle pusher ping event
    socket.on('pusher:ping', () => {
      socket.emit('pusher:pong')
    })


    socket.on('pusher:unsubscribe', (data: string) => {
      const payload = JSON.parse(data) as { channel: string }
      PusherServer.removeClientFromChannel(socket, payload.channel, this.app)
    })

    socket.on('pusher:subscribe', async (data: string) => {
      const result = await PusherServer.addClientToChannel(socket, this.app, data);
      const payload = result.payload;
      if (result.success && (PusherServer.isPresenceChannel(payload.channel) || PusherServer.isPrivateChannel(payload.channel))) {
        // @todo checks if app is allowing client to send messages/events
        const allow = true;
        if (allow) {
          socket.onAny((eventName, eventData) => {
            if (eventName.indexOf('client-') === 0) {
              socket.to(payload.channel)
                .emit(eventName, eventData)
              const webhookPayload = {
                channel: payload.channel,
                event: eventName,
                data: eventData,
                socket_id: socket.id as string,
                user_id: socket._powwow.user_id as string
              };
              Webhook.publishClientEvent(webhookPayload, this.app);
            }
          })
        }
      }
    })
  }


  /**
   * Check if this socket has join at least one private or presence channel
   * 
   * @param {Socket} socket 
   * 
   * @returns  {boolean}
   */
  private hasJoinAuthChannel(socket: IPusherSocket): boolean {
    let valid = false;
    if (socket._pusherChannels.size === 0) {
      PusherServer.sendError(socket, PusherServer.errorCode[4009])
    } else {
      let done = true;
      const interator = socket._pusherChannels.keys()
      do {
        const result = interator.next()
        done = result.done
        if (result.value && (result.value.indexOf('private-') === 0 || result.value.indexOf('presence-') === 0)) {
          valid = true
          break;
        }
      } while (!done)
    }

    return valid
  }

  private doConnectionAuth(socket: IPusherSocket) {
    setTimeout(() => {
      if (!this.hasJoinAuthChannel(socket)) {
        PusherServer.sendError(socket, PusherServer.errorCode[4009])
      }
    }, 30000);

  }

}