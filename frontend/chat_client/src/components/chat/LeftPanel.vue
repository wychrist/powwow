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
        <avatar-list-item
          :title="roomTitle"
          subTitle="Room description"
          @click="roomClicked"
        >
        </avatar-list-item>
      </q-tab-panel>
      <q-tab-panel class="bg-dark" name="dms">
        <avatar-list-item
          :title="dmTitle"
          subTitle="status message"
          @click="dmClicked"
        >
        </avatar-list-item>
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
import AvatarListItem from './AvatarListItem.vue'

export default defineComponent({
  name: 'LeftChatPanel',
  components: {
    AvatarListItem
  },
  emits: ['roomTitle', 'dmTitle'],
  created () {
    this.$emit('roomTitle', this.roomTitle)
  },
  setup () {
    return {
      roomTitle: 'A Room Name',
      dmTitle: 'Username',
      tab: ref('rooms'),
    }
  },
  methods: {
    dmClicked () {
      this.$emit('dmTitle', this.dmTitle)
    },
    roomClicked () {
      this.$emit('roomTitle', this.roomTitle)
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
