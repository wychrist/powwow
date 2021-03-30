<template>
  <q-page class="row items-center justify-evenly">
    <div>
       {{ messages }}
    </div>
    <hr />
    <q-input v-model="newMessage" @keyup="doSend">
    </q-input>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
// import { client, appClient } from 'src/lib/socketio'
import { Pusher } from '../lib/pusher/Pusher'

export default defineComponent({
  name: 'PageIndex',
  setup() {
    const key = 'f97b3be0c78ac08b953aa486565786c120e7de03914df750612b9c52afce7528'
    const client = new Pusher(key)
    client.connection.bind('connected', (data) => {
      console.log('we are connected to the sever!!', data)
    }).bind('error', (data) => {
      console.log('could not connect to the server :(', data)
    })
    console.log('client', client.getStatus())
    let newMessage = ref<string>('')
    let messages = ref<string[]>([])

    // test sending events to server
    let doSend = (event: { key: string})  => {
      if (event.key.toString().toLowerCase() === 'enter') {
        // client.emit('message',  newMessage.value)
        messages.value.push(newMessage.value)
        newMessage.value = ''
      }
    }

    // test handling events from server
    /*client.on('message', (msg: string) => {
      messages.value.push(msg)
    }) */


    return {
      doSend,
      messages,
      newMessage
    };
  }
});
</script>
