
import { Namespace, Socket } from "socket.io";
import { Application } from "../entity/Application";
import { PusherServer } from "./PusherServer";
import { PusherSocket } from '../type/Interfaces'

export class PusherApplication {

  private ns: Namespace;
  private app: Application;

  constructor(ns: Namespace, app: Application) {
    this.ns = ns;
    this.app = app;
  }

  authenticate(socket: PusherSocket) {
    console.log(`socket connected on ${this.app.name}`, socket.id)

    this.doConnectionAuth(socket); // wait for a specified timeout and see if the client has joined a private room
    this.acceptConnection(socket);
    this.registerEventHandlers(socket);

  }

  acceptConnection(socket: Socket) {
    socket.emit('pusher:connection_established', JSON.stringify({
      socket_id: socket.id,
      activitiy_timeout: 120
    }))
    console.log("we got a new connection: " + socket.id);
  }

  private registerEventHandlers(socket: PusherSocket) {
    // handle client disconnet event
    socket.on('disconnect', (reason) => {
      console.log('client disconnected', reason);
    });

    // Handle client disconnecting event
    socket.on('disconnecting', (reason) => {
      console.log('client disconnecting', reason);
    });

    // handle pusher ping event
    socket.on('pusher:ping', () => {
      socket.emit('pusher:pong')
    })


    socket.on('pusher:unsubscribe', (data: string) => {
      PusherServer.removeClientFromChannel(socket, data)
    })

    socket.on('pusher:subscribe', (data: string) => {
      if (PusherServer.addClientToChannel(socket, this.app, data)) {
        // @todo log the user as connected
      } else {
        // @todo ...
      }
    })
  }

  private hasJoinAuthChannel(socket: PusherSocket): boolean {
    let valid = false;
    if (socket._pusherChannels.size === 0) {
      PusherServer.sendError(socket, PusherServer.errorCode[4009])
    } else {
      let done = true;
      const interator = socket._pusherChannels.values()
      do {
        const result = interator.next()
        done = result.done
        if (result.value && (result.value.indexOf('private-') === 0 || result.value.indexOf('presence-') === 0)) {
          valid = true
          break;
        }
      } while (!done)
    }


    console.log(`socker ${socket.id} has right to ?`, valid)

    return valid
  }

  private doConnectionAuth(socket: PusherSocket) {
    setTimeout(() => {
      if (!this.hasJoinAuthChannel(socket)) {
        PusherServer.sendError(socket, PusherServer.errorCode[4009])
      }
    }, 30000);

  }

}