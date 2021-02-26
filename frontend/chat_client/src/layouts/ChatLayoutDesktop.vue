<template>
  <q-layout class="bg-dark" view="lhr lpr lfr">

    <q-header elevated class="bg-primary text-white" height-hint="98">
      <q-toolbar>
        <q-btn dense flat round icon="people" @click="toggleLeftDrawer"></q-btn>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg">
          </q-avatar>
          {{roomName}}
        </q-toolbar-title>

        <q-btn dense flat round icon="import_contacts" @click="toggleRightDrawer" />
      </q-toolbar>

    </q-header>

    <q-drawer :width="350" class="bg-primary" show-if-above v-model="leftDrawerOpen" side="left" bordered>
      <users-and-rooms-panel></users-and-rooms-panel>
    </q-drawer>

    <q-drawer class="bg-dark" :width="600" v-model="rightDrawerOpen" side="right" bordered>
      Bible Study Tools
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script lang="ts">
import { ref, defineComponent } from 'vue'
import UsersAndRoomsPanel from '../components/chat/LeftPanel.vue'

export default defineComponent({
  components: {
    UsersAndRoomsPanel
  },
  setup () {
    const leftDrawerOpen = ref(false)
    const rightDrawerOpen = ref(false)

    return {
      roomName: 'Room Name',
      leftDrawerOpen,

      rightDrawerOpen,
      toggleRightDrawer () {
        rightDrawerOpen.value = !rightDrawerOpen.value
      },
      toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
      }
    }
  }
})
</script>
