<template>
  <q-input
    outlined
    class="full-width"
    bg-color="white"
    v-model="msg"
    maxlength="msgLength"
    placeholder="Your message"
    autogrow
    square
    @keyup="keyUp"
    @keydown="onKeyDown"
  >
    <template v-slot:prepend>
      <q-btn round dense flat icon="emoji_emotions">
        <q-menu anchor="center left" self="bottom middle">
          <div class="row no-wrap q-pa-md">
            <div class="column">
              <div class="text-h6 q-mb-md">Settings</div>
            </div>

            <q-separator vertical inset class="q-mx-lg" />

            <div class="column items-center">
              <q-avatar size="72px">
                <img src="https://cdn.quasar.dev/img/avatar4.jpg" />
              </q-avatar>

              <div class="text-subtitle1 q-mt-md q-mb-xs">John Doe</div>

              <q-btn color="primary" label="Logout" push size="sm" v-close-popup />
            </div>
          </div>
        </q-menu>
      </q-btn>
    </template>
    <template v-slot:append>
      <q-btn round dense flat icon="add">
        <q-menu anchor="center left" self="bottom middle">
          <q-item clickable>
            <q-item-section>New tab</q-item-section>
          </q-item>
          <q-item clickable>
            <q-item-section>New incognito tab</q-item-section>
          </q-item>
        </q-menu>
      </q-btn>
      <q-btn round dense flat icon="mic" />
    </template>
  </q-input>
</template>

<script lang="ts">
import { defineComponent, PropType, ref } from 'vue'
import { emits } from '../../composables/chat/InputBox'

export default defineComponent({
  name: 'ChatInputBox',
  props: {
    disabled: {
      type: Boolean,
      default: false
    },
    msgLength: {
      type: Number as PropType<number>,
      default: 255
    }
  },
  emits: [
    ...emits
  ],
  setup (props, ctx) {
    let presses: { [key: string]: boolean } = {}
    const msg = ref<string>('hello word')

    setTimeout(() => {
      msg.value = 'it is good that you are here'
    }, 10000)

    const keyUp =  () => {
      const enteredKey = 'Enter'
      const shiftKey = 'Shift';
      if (presses[enteredKey] && !presses[shiftKey]) {
        ctx.emit('updateValue',msg.value.trim())
        msg.value = ''
        presses = {}
      } else  {
        if (msg.value.length > props.msgLength) {
          msg.value = msg.value.substring(0, props.msgLength)
        }
        presses = {}
      }
    }

    function onKeyDown (event: KeyboardEvent) {
      presses[event.key] = true;
    }

    return {
      msg,
      onKeyDown,
      keyUp
    };
  }
})
</script>
