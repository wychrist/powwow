<template>
  <div>
      <q-input
        standout
        dark
        placeholder="Type here to send a message to @friendname"
        class="stick-bottom bg-primary full-width"
      >
        <template
          v-slot:prepend
        >
          <q-icon name="tag_faces"></q-icon>
        </template>
        <template
          v-slot:append
        >
          <q-icon name="microphone"></q-icon>
        </template>
      </q-input>

  </div>
</template>

<script>
export default {
  name: 'MainChatArea',
}
</script>

<style>
.stick-bottom {
  position:absolute;
  bottom: 2px;
}
</style>
