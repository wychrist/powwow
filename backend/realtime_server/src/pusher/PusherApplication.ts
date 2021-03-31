
import { Namespace, Socket } from "socket.io";
import { Application } from "../entity/Application";
import { Pusher } from "./Pusher";
import { PusherSocket } from '../type/Interfaces'

export class PusherApplication {

  private ns: Namespace;
  private app: Application;

  constructor(ns: Namespace, app: Application) {
    this.ns = ns;
    this.app = app;
  }

  authenticate(socket: PusherSocket) {
    socket._pusherChannels = new Set<string>();

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

  private registerEventHandlers(socket: Socket) {
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
      console.log('we got a ping from the client', Date.now())
    })
  }

  private doConnectionAuth(socket: PusherSocket) {
    setTimeout(() => {
      if (socket._pusherChannels.size === 0) {
        Pusher.sendError(socket, Pusher.errorCode[4009])
      } else {
        let done = true;
        let valid = false;
        const interator = socket._pusherChannels.values()
        do {
          const result = interator.next()
          done = result.done
          console.log('validating using the current channel', result.value)
          if (result.value && (result.value.indexOf('private-') === 0 || result.value.indexOf('presence-') === 0)) {
            valid = true
            break;
          }
        } while (!done)

        if (!valid) {
          Pusher.sendError(socket, Pusher.errorCode[4009])
        }
      }
    }, 30000);

  }

}