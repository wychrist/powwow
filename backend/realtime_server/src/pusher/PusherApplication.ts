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
    // wait for a specified timeout and see if the client has joined a private room

    socket.on('disconnect', (reason) => {
      console.log('client disconnected', reason);
    });

    socket.on('disconnecting', (reason) => {
      console.log('client disconnecting', reason);
    });
  }
}