<template>
  <q-layout view="hHh Lpr fFf">

    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="../assets/img/logo.png">
          </q-avatar>
          Wyreema Christians Inc.
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'LoginLayout',

  components: {

  },

  setup () {
    return {

    }
  }
})
</script>
