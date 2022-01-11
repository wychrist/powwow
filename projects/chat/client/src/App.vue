<template>
  <router-view />
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export interface Window {
    api: (n: number) => number
  }


export default defineComponent({
  name: 'App'
})
</script>
