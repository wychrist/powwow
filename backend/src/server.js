import { createServer } from "http";
import { Server } from "socket.io";
import { fileURLToPath } from "url";
import { dirname } from "path";
import dotenv from "dotenv";
import fs from "fs";

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

const envFilePath = `${__dirname}/../../.env`;
const envFilePathFallback = `${__dirname}/../../.env.example`;

if (fs.existsSync(envFilePath)) {
  dotenv.config({
    path: envFilePath,
  });
} else {
  dotenv.config({
    path: envFilePathFallback,
  });
}

const PORT = process.env.CP_SERVER_PORT;
const httpServer = createServer();
const io = new Server(httpServer, {
  cors: {
    origin: "*",
    methods: ["GET", "POST", "PUT", "DELETE"]
  },
  // we are not using another websocket
  // ws is awesome and we are sticking with it!!! :)
});

io.on("connection", (socket) => {
  console.log("we got a new connection!!!!!!!!");
  socket.on("message", (msg) => {
    // io.emit('message', msg);
    // test broadcasting message received from a client to other clients
    socket.broadcast.emit('message', msg)
  });
});

httpServer.listen(PORT, () => {
  console.log("We are waiting for connection on port: " + PORT);
});
