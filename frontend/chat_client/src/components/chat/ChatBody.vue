<template>
  <q-page>
    <q-toolbar class="flat dense bg-grey-4" dense>
      <q-btn flat :label="name" />
      <q-space />

      <q-btn flat round dense>
        <q-icon name="more_vert" />
      </q-btn>
    </q-toolbar>

    <input-box class="input-field"></input-box>
  </q-page>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import InputBox from './InputBox.vue';

export default defineComponent({
  name: 'ChatBody',
  components: {
    InputBox
  },
  setup () {
    return {
        name: 'Room Name'
    }
  }
})
</script>

<style scoped>
.input-field {
  position: absolute;
  bottom: 10px;
}
</style>
