<template>
  <q-page class="row">
      <code class='q-pa-md'>
          {{ message }}
      </code>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { io } from 'socket.io-client'

export default defineComponent({
  name: 'PageIndex',
  components: { },
  setup () {
    const message = ref('')

    const socket = io('http://192.168.20.20:3000')

    socket.on('connect', function () {
      socket.on('section', (event: { content: string}) => {
        console.log('text from server', event.content)
        message.value = event.content.trim()
      })
      console.log('we are connected to the websocket server')
    })

    return {
      message
    }
  }
})
</script>
