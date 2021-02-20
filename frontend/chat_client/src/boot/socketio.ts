// import something here
import { io, Socket } from 'socket.io-client'

import { boot } from 'quasar/wrappers'
declare module 'vue/types/vue' {
  interface Vue {
    cpSocket: Socket
  }
}

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/boot-files
export default boot(({ Vue }/* { app, router, Vue ... } */) => {
  // something to do
  const chatDomain = document.querySelector("meta[name='cp_chat_server']")?.getAttribute("content") || 'http://localhost:3000'
  const client = io(chatDomain)
  Vue.prototype.cpSocket = client
})
