<template>
            <q-input
              v-model="email"
              label="Email"
              name="email"
              placeholder="doe.j@example.com"
              type="email"
              required
            />
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'FormInputField',
  setup () {
    return {
      email: ref('')
    }
  }
})
</script>
