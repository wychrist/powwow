<template>
  <div class="column" v-if="!setup" @click="setup='server'">
    <div class="col-4 col-xs-12 self-center q-pa-md">
      <q-btn>
      Setup full server
      </q-btn>
    </div>
    <div class="col-4 col-xs-12 self-center q-pa-md">
      <q-btn>
      Setup an application
      </q-btn>
    </div>
  </div>
  <server-setup v-if="setup === 'server'"></server-setup>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import ServerSetup from '../components/setup/Server'

export default defineComponent({
  name: 'SetupPage',
  components: {
    ServerSetup
  },
  setup() {
    const setup = ref(null)
    return {
      setup
    }
  },
})
</script>

