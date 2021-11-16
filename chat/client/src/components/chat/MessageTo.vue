<template>
      <q-chat-message
        name="Jane"
        avatar="https://cdn.quasar.dev/img/avatar5.jpg"
        :text="message"
        stamp="4 minutes ago"
        text-color="white"
        bg-color="primary"
      />
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'

export default defineComponent({
  name: 'MessageToMe',
  props: {
    message: {
      type: Array as PropType<Array<string>>,
      required: true
    }
  },
  setup() {
    return {}
  },
})
</script>
