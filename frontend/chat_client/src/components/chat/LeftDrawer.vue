<template>
  <div>
    <q-tabs v-model="tab" class="bg-grey-3" dense align="center">
      <q-tab name="tab1" icon="far fa-comments" label="Rooms">
        <q-tooltip anchor="bottom middle" self="top middle">Your rooms</q-tooltip>
      </q-tab>
      <q-tab name="tab2" icon="fas fa-user-friends" label="Friends">
        <q-tooltip anchor="bottom middle" self="top middle">Your Friends</q-tooltip>
      </q-tab>
      <q-tab name="tab3" icon="fas fa-user-cog" label="Me">
        <q-tooltip anchor="bottom middle" self="top middle">Settings</q-tooltip>
      </q-tab>
    </q-tabs>
    <q-tab-panels v-model="tab" animated>
      <q-tab-panel name="tab1">
        <!--- new -->
        <q-card flat>
          <q-tabs v-model="roomstab" class="text-teal" dense>
            <q-tab label="Mine" name="minerooms" />
            <q-tab label="All" name="allrooms" />
          </q-tabs>

          <q-separator></q-separator>

          <q-tab-panels v-model="roomstab" animated>
            <q-tab-panel name="minerooms">List of all your rooms</q-tab-panel>

            <q-tab-panel name="allrooms">
              <room-collection-card  :rooms="rooms"></room-collection-card>
            </q-tab-panel>
          </q-tab-panels>
        </q-card>
        <!---// new -->
      </q-tab-panel>
      <q-tab-panel name="tab2">
        <!--- new -->
        <q-card flat>
          <q-tabs v-model="friendstab" class="text-teal" dense>
            <q-tab label="Mine" name="minefriends" />
            <q-tab label="All" name="people" />
          </q-tabs>

          <q-separator></q-separator>

          <q-tab-panels v-model="friendstab" animated>
            <q-tab-panel name="minefriends">List of all your friends</q-tab-panel>

            <q-tab-panel name="people">List of people</q-tab-panel>
          </q-tab-panels>
        </q-card>
        <!---// new -->
      </q-tab-panel>
      <q-tab-panel name="tab3">The user current settings</q-tab-panel>
    </q-tab-panels>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import RoomCollectionCard from './RoomCollectionCard.vue'

export default defineComponent({
  name: 'ChatLayoutLeftDrawer',
  components: {
    RoomCollectionCard
  },
  setup () {
    return {
      tab: 'tab1',
      roomstab: 'minerooms',
      friendstab: 'minefriends',
      rooms: []
    }
  }
})
</script>
