<template>
  <q-expansion-item
        expand-icon-toggle
        expand-separator
        :icon=icon
        :label=title
        group="main_menu"
      >
      <q-item
        clickable
        tag="a"
        target="_blank"
        href="#"
      >
        <q-item-section
          v-if="icon"
          avatar
        >
          <q-icon :name="icon" />
        </q-item-section>

        <q-item-section>
          <q-item-label>{{ title }}</q-item-label>
        </q-item-section>
    </q-item>
  </q-expansion-item>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'EssentialLink',
  props: {
    title: {
      type: String,
      required: true
    },

    caption: {
      type: String,
      default: ''
    },

    link: {
      type: String,
      default: '#'
    },

    icon: {
      type: String,
      default: ''
    }
  }
})
</script>
