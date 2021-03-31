import "reflect-metadata";
import env from './setup_env'
import { createConnection, Equal } from "typeorm";
import * as express from "express";
import * as bodyParser from "body-parser";
import { Request, Response } from "express";
import { Routes } from "./routes";
import { Server, Socket } from "socket.io";
import { createServer } from 'http'
import { getSettings } from './settings'
import { getRepository } from "typeorm";
import { Application } from './entity/Application'
import { PusherApplication } from './pusher/PusherApplication'
import { Pusher } from './pusher/Pusher'

const socketIoOption = {
    cors: {
        origin: "*",
        methods: ["GET", "POST", "PUT", "DELETE"]
    },
    // we are not using another websocket
    // ws is awesome and we are sticking with it!!! :)
}
const activeApplications: { [key: string]: PusherApplication } = {}

createConnection().then(async connection => {
    getSettings()

    // create express app
    const app = express();
    const server = createServer(app)
    const io = new Server(server, socketIoOption)
    const appRepo = getRepository(Application)
    const pusher = new Pusher()
    app.use(bodyParser.json());

    // register express routes from defined application routes
    Routes.forEach(route => {
        (app as any)[route.method](route.route, (req: Request, res: Response, next: Function) => {
            const result = (new (route.controller as any))[route.action](req, res, next);
            if (result instanceof Promise) {
                result.then(result => result !== null && result !== undefined ? res.send(result) : undefined)
                    .catch((error) => {
                        // @todo handle 
                    });

            } else if (result !== null && result !== undefined) {
                res.json(result);
            }
        });
    });


    io.on("connection", (socket) => {
        // set a timeout and see if the client has joined an application
        // if not, close the connection
    });


    io.of(/^\/\w+$/)
        .on('connection', (socket) => {
            const appKey = socket.nsp.name.replace('/', '').trim()
            if (!activeApplications[appKey]) {
                appRepo.findOne({ where: { key: Equal(appKey) } })
                    .then((app) => {
                        if (app) {
                            activeApplications[appKey] = new PusherApplication(socket.nsp, app)
                            activeApplications[appKey].authenticate(socket)
                        } else {
                            Pusher.sendError(socket, Pusher.errorCode[4001])
                        }
                    })
                    .catch(() => {
                        Pusher.sendError(socket, Pusher.errorCode[4009])
                    })
            } else {
                activeApplications[appKey].authenticate(socket)
            }
        })

    // setup express app here
    // ...

    // start express server
    server.listen(env.CP_REALTIME_PORT);

    // insert new users for test
    /* await connection.manager.save(connection.manager.create(User, {
        firstName: "Timber",
        lastName: "Saw",
        age: 27
    }));
    await connection.manager.save(connection.manager.create(User, {
        firstName: "Phantom",
        lastName: "Assassin",
        age: 24
    })); */

    console.log(`Realtime server has started on port ${env.CP_REALTIME_PORT}.`);

}).catch(error => console.log(error));
