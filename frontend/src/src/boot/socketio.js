// import something here
import socketio from 'socket.io-client'

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/boot-files
export default async (/* { app, router, Vue ... } */) => {
  // something to do
  const client = new socketio('http://localhost:3000')
}
