<template>
  <q-input
    outlined
    class="full-width"
    bg-color="white"
    v-model="message"
    placeholder="Your message"
    autogrow
    square
    @keyup="onKeyUp"
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
    <template slot="append">
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
import { defineComponent } from 'vue'
interface IPresses {
  [key: string ]: boolean
}

export default defineComponent({
  name: 'ChatInputBox',
  props: {
    disabled: {
      type: Boolean,
      default: false
    }
  },
  setup () {
    let presses: { [key: string] : boolean } = {}
    return {
      presses,
      message: ''
    };
  },
  methods: {
    onKeyDown(event: KeyboardEvent) {
      this.presses[event.code] = true;
    },
    onKeyUp() {
      let enteredKey = '13';
      let shiftKey = '16';

      // Don't send textarea data if shift is down
      if (this.presses[enteredKey] && !this.presses[shiftKey]) {
        if (this.message.trim()) {
          this.$emit('input', this.message);
          this.message = '';
        }
      } else {
        this.$emit('textcount', this.message.length);
      }

      this.presses = {}
    }
  }
})
</script>
