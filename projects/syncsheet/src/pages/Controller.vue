<template>
  <div style="background-color:black" class="q-pa-md">
    <song-section v-for="(content, index) in fakeSong" :key="index" :content="content">
    </song-section>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import SongSection from 'components/song/Secton.vue'

export default defineComponent({
  components: {
    SongSection
  },
  setup () {
    const fakeSong = ref<string[]>([
`Lord I lift Your name on high
Lord I love to sing Your praises
I'm so glad You're in my life
I'm so glad You came to save us`,

`You came from heaven to earth
To show the way
From the earth to the cross
My debt to pay
From the cross to the grave
From the grave to the sky
Lord I lift Your name on high`,

`Lord, I lift Your name on high
Lord, I love to sing Your praises
I'm so glad You're in my life
I'm so glad You came to save us`,

`You came from Heaven to earth to show the way
From the earth to the cross my debt to pay
From the cross to the grave
From the grave to the sky
Lord, I lift Your name on high`,

`You came from Heaven to earth to show the way
From the earth to the cross my debt to pay
From the cross to the grave
From the grave to the sky
Lord, I lift Your name on high`,

`Lord, I lift Your name on high
Lord, I love to sing Your praises
I'm so glad You're in my life
I'm so glad You came to save us`,

`You came from Heaven to earth to show the way
From the earth to the cross my debt to pay
From the cross to the grave
From the grave to the sky
Lord, I lift Your name on high`,

`Lord, I lift Your name on high
Lord, I lift Your name on high
Lord, I lift Your name on high
Lord, I lift Your name on high
Lord, I lift Your name on high
Lord, I lift Your name on high..`
    ])

    return {
      fakeSong
    }
  }
})
</script>
