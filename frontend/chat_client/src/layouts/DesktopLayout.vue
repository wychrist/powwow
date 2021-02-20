<template>
  <q-layout view="hHh lpR fFf">
    <q-header class="bg-dark text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title>
          <q-avatar v-show="logo">
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg" />
          </q-avatar>
          {{name}}
        </q-toolbar-title>

        <q-btn dense flat round icon="menu" @click="right = !right" />
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="left" side="left" bordered>
      <!-- drawer content -->
      <left-drawer></left-drawer>
    </q-drawer>

    <q-drawer show-if-above v-model="right" side="right" bordered>
      <!-- drawer content -->
      <right-drawer></right-drawer>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import LeftDrawer from 'components/chat/LeftDrawer.vue';
import RightDrawer from 'components/chat/RightDrawer.vue'

export default defineComponent({
  components: {
    LeftDrawer,
    RightDrawer
  },
  setup () {

    return {
      left: false,
      right: false,
      name: '\\o/\\o/ Powwow',
      logo: false
    }
  }
})
</script>
