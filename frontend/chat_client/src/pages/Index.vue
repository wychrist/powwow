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
import { client } from 'src/lib/socketio'

export default defineComponent({
  name: 'PageIndex',
  setup() {

    let newMessage = ref<string>('')
    let messages = ref<string[]>([])

    // test sending events to server
    let doSend = (event: { key: string})  => {
      if (event.key.toString().toLowerCase() === 'enter') {
        client.emit('message',  newMessage.value)
        messages.value.push(newMessage.value)
        newMessage.value = ''
      }
    }

    // test handling events from server
    client.on('message', (msg: string) => {
      messages.value.push(msg)
    })


    return {
      doSend,
      messages,
      newMessage
    };
  }
});
</script>
