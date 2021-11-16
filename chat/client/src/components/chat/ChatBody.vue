<template>
  <q-page>
    <q-toolbar class="flat dense bg-grey-4" dense>
      <q-btn flat :label="name" />
      <q-space />

      <q-btn flat round dense>
        <q-icon name="more_vert" />
      </q-btn>
    </q-toolbar>
        <div v-for="(message, id) in messages.list" :key="id">
          {{ message }}
        </div>
      <component
        v-for="message in messages.list"
        :key="message.props.id"
        :is="message.component"
        v-bind="message.props"
      >
      </component>
    <input-box2 v-model="newMessage" @updateValue="onMessageToSend"></input-box2>
    <input-box class="input-field" v-model="newMessage" @updateValue="onMessageToSend"></input-box>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref, reactive } from 'vue'
import InputBox from './InputBox.vue';
import InputBox2 from './InputBox2.vue'
import MessageFrom from './MessageFrom.vue'
import MessageTo from './MessageTo.vue'


/* interface IMessage {
  message: string,
  timestamp: string
} */

interface IMessageComponent {
  props: {
    id: number,
    message: string[],
    timestamp: string
  },
  component: string
}

export default defineComponent({
  name: 'ChatBody',
  components: {
    InputBox,
    InputBox2,
    MessageFrom,
    MessageTo
  },
  setup () {
    const newMessage = ref<string>('')
    const messages = reactive<{list: {[key: number]: IMessageComponent}}>({list: {}})

    function onMessageToSend(message: string) {
      const id = Date.now()
      messages.list[id] = {
        component: 'MessageFrom',
        props: {
          id,
          message: [message, 'Are we having fun???'],
          timestamp: '....'
        }
      }

      setTimeout(() => {
        messages.list[id] = {
          component: 'MessageFrom',
          props: {
           id,
            message: [message, 'Are we having fun???'],
            timestamp: 'Ten dayes ago: ' + Date.now().toString()
          }
        }
        console.log('sending message', message)
      }, 2000);
    }

    return {
        name: 'Room Name',
        newMessage,
        onMessageToSend,
        messages
    }
  }
})
</script>

<style scoped>
.input-field {
  position: absolute;
  bottom: 10px;
}
</style>
