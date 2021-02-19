import { createServer } from "http";
import { Server } from "socket.io";

const httpServer = createServer();
const io = new Server(httpServer, {
    cors: {
        origin: '*'
    }
    // we are not using another websocket
    // ws is awesome and we are sticking with it!!! :)
});

io.on("connection", (socket) => {
    console.log('we got a new connection!!!!!!!!');
});

httpServer.listen(3000, () => {
    console.log('We are waiting for connection on port: ' + 3000)
});