<template>
 <q-chat-message
    name="me"
    avatar="https://cdn.quasar.dev/img/avatar1.jpg"
    :text="message"
    :stamp="ts"
    sent
    bg-color="amber-7"
  />
</template>


<script lang="ts">
import { defineComponent, PropType, computed } from 'vue'

export default defineComponent({
  name: 'MessagetoMe',
  props: {
    message:{
      type: Array as PropType<string[]>,
      required: true
    },
    timestamp: {
      type: String as PropType<string>
    }
  },
  setup(props) {

    const ts = computed(() => {
      return props.timestamp
    })


    return {
      ts
    }
  },
})
</script>
