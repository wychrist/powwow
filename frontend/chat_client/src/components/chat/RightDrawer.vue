<template>
  <div>
    <q-tabs v-model="tab" class="bg-grey-3" dense  align="center">
      <q-tab name="tab1" icon="far fa-comment-dots" label="Chats">
        <q-tooltip anchor="bottom middle" self="top middle">Active chat session</q-tooltip>
      </q-tab>
      <q-tab name="tab2" icon="fas fa-toolbox"  label="Tools">
        <q-tooltip anchor="bottom middle" self="top middle">Useful tool</q-tooltip>
      </q-tab>
      <q-tab name="tab3" icon="fas fa-search" label="Search">
        <q-tooltip anchor="bottom middle" self="top middle">Search...</q-tooltip>
      </q-tab>
    </q-tabs>
    <q-tab-panels v-model="tab" animated>
      <q-tab-panel name="tab1">
          <q-input label="Search this list"></q-input>
          Active chats sorted by recent message
      </q-tab-panel>
      <q-tab-panel name="tab2">
          Users online that have their profile public
      </q-tab-panel>
      <q-tab-panel name="tab3">List of all rooms</q-tab-panel>
    </q-tab-panels>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
  name: 'ChatLayoutLeftDrawer',
  setup () {
    return {
      tab: 'tab1'
    }
  }
})
</script>
