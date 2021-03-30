import { Namespace, Server, Socket } from "socket.io";
import { Application } from "../entity/Application";


export class PusherApplication {

  private ns: Namespace;
  private app: Application;

  constructor(ns: Namespace, app: Application) {
    this.ns = ns;
    this.app = app;
  }

  authenticate(socket: Socket) {

    console.log(`socket connected on ${this.app.name}`, socket.id)
    this.acceptConnection(socket)

    // wait for a specified timeout and see if the client has joined a private room

    socket.on('disconnect', (reason) => {
      console.log('client disconnected', reason);
    });

    socket.on('disconnecting', (reason) => {
      console.log('client disconnecting', reason);
    });

    socket.on('pusher:ping', () => {
      socket.emit('pusher:pong')
      console.log('we got a ping from the client', Date.now())
    })
  }

  acceptConnection(socket: Socket) {
    socket.emit('pusher:connection_established', JSON.stringify({
      socket_id: socket.id,
      activitiy_timeout: 120
    }))
    console.log("we got a new connection: " + socket.id);
  }

  sendError(socket: Socket, code: number, message: string) {
    socket.emit('pusher:error', JSON.stringify({
      code,
      message
    }))
  }


}