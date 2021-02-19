// import something here
import { io } from 'socket.io-client'

console.log('env con', JSON.stringify(process.env), __filename)

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/boot-files
export default async ({ Vue }/* { app, router, Vue ... } */) => {
  // something to do
  const chatDomain = document.querySelector("meta[name='cp_chat_server']")?.getAttribute("content") || 'http://localhost:3000'
  const client = io(chatDomain)
}
