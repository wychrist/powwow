<template>
  <div @click="onClick" clickable class="q-mb-md" :style="{color: fontColor }">
     {{ content }}
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import axios, { AxiosResponse } from 'axios'

export default defineComponent({
  name: 'SongSection',
  props: {
    content: {
      type: String,
      required: true
    }
  },
  setup (props) {
    const api = axios.create({
      baseURL: 'http://192.168.20.20:3000'
    })
    const fontColor = ref('gray')
    function onClick () {
      console.log('clicked')
      api.post('section', { content: props.content })
        .then((result: AxiosResponse<{ success: boolean }>) => {
          console.log('sent to server', result)
          fontColor.value = 'white'
        }).catch((error) => {
          console.error('error sending to server', error)
        })
    }
    return {
      onClick,
      fontColor
    }
  }
})
</script>
