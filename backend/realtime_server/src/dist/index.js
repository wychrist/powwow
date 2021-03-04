"use strict";
exports.__esModule = true;
var http_1 = require("http");
var socket_io_1 = require("socket.io");
var url_1 = require("url");
var path_1 = require("path");
var Server_1 = require("./pusher/Server");
var __filename = url_1.fileURLToPath(import.meta.url);
var __dirname = path_1.dirname(__filename);
/*const envFilePath = `${__dirname}/../../../.env`;
const envFilePathFallback = `${__dirname}/../../../.env.example`;

if (fs.existsSync(envFilePath)) {
  dotenv.config({
    path: envFilePath,
  });
} else {
  dotenv.config({
    path: envFilePathFallback,
  });
} */
var PORT = process.env.CP_SERVER_PORT || 3000;
var httpServer = http_1.createServer();
var io = new socket_io_1.Server(httpServer, {
    cors: {
        origin: "*",
        methods: ["GET", "POST", "PUT", "DELETE"]
    }
});
var pusherServer = new Server_1.Server();
io.on("connection", function (socket) {
    console.log("we got a new connection: " + socket.id);
    /*socket.on('client_pusher_event', (event: IMessage) => {
      pusherServer.handleEvent(event, socket)
    }) */
    socket.on("message", function (msg) {
        // io.emit('message', msg);
        // test broadcasting message received from a client to other clients
        socket.broadcast.emit('message', msg);
    });
});
httpServer.listen(PORT, function () {
    console.info("We are waiting for connection on port: " + PORT);
});
