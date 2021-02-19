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
import { Todo, Meta } from 'components/models';
import { defineComponent, ref } from '@vue/composition-api';

export default defineComponent({
  name: 'PageIndex',
  setup(props, ctx) {

    let newMessage = ref<String>('')
    let messages = ref<String[]>([])

    // test sending events to server
    let doSend = (event)  => {
      if (event.key.toString().toLowerCase() === 'enter') {
        ctx.root.cpSocket.emit('message',  newMessage.value)
        messages.value.push(newMessage.value)
        newMessage.value = ''
      }
    }

    // test handling events from server
    ctx.root.cpSocket.on('message', (msg) => {
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
