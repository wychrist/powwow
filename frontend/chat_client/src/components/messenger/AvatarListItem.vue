<template>
  <div>
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
          <q-item-label class="text-white">{{title}}</q-item-label>
          <q-item-label caption lines="1" class="text-white">{{subTitle}}</q-item-label>
        </q-item-section>
      </q-item>
    </q-list>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'AvatarListItem',
  props: {
    title: String,
    subTitle: String
  }
})

</script>

<style>

</style>
