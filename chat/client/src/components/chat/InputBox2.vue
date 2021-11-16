<template>
  <input type="text" style="width: 100%; background-color:red"
    @keyup="onKeyUp"
    @keydown="onKeyDown"
    v-model="refMessage"
  />
</template>

<script lang="ts">
import { useInputBox, emits } from '../../composables/chat/InputBox'
import { defineComponent } from 'vue'

export default defineComponent({
  emits: [
    ...emits
  ],
  setup(_, ctx) {
    return {
      ...useInputBox(200, ctx)
    }
  }
})
</script>
