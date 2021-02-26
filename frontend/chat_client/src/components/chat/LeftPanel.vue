<template>
  <div>
      <q-input dark dense standout="bg-accent text-white" placeholder="Search..." class="q-ma-sm">
      <template v-slot:prepend>
        <q-icon name="search"></q-icon>
      </template>
    </q-input>
    <q-tabs
      v-model="tab"
      dense
      class="bg-accent q-mx-sm"
      align="justify"
      active-bg-color="dark"
    >
      <q-tab class="text-white" icon="meeting_room" name="rooms" label="Rooms"/>
      <q-tab class="text-white" icon="message" name="dms" label="Messages" />
    </q-tabs>
    <q-tab-panels
      v-model="tab"
      animated
      class="q-mx-sm"
    >
      <q-tab-panel class="bg-dark" name="rooms">
        <q-list>
          <q-item>
            <q-item-section avatar>
              <q-avatar
                color="accent" text-color="white"
              >
              </q-avatar>
            </q-item-section>
            <q-item-section
            >
              <q-item-label class="text-white">Room Name</q-item-label>
              <q-item-label caption lines="1" class="text-white">Subtitle</q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </q-tab-panel>
      <q-tab-panel class="bg-dark" name="dms">
        this is the dms
      </q-tab-panel>
    </q-tab-panels>
    <div class="stick-bottom bg-dark justify" style="height: 56px; width: 100%">
      <q-btn-group spread>
        <q-btn class="text-white text-caption" stack icon="add_circle_outline" flat label="friend/room"></q-btn>
        <q-btn class="text-white text-caption" stack icon="account_circle" flat label="Profile"></q-btn>
        <q-btn class="text-white text-caption" stack icon="settings" flat label="Settings"></q-btn>
      </q-btn-group>
    </div>
  </div>
</template>
<script>
import { ref, defineComponent } from 'vue'

export default defineComponent({
  name: 'LeftChatPanel',
  setup () {
    return {
      tab: ref('rooms')
    }
  }
})
</script>

<style>
.stick-bottom {
  position:absolute;
  bottom: 0;
}
</style>
