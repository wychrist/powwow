<template>
  <q-page class="row items-center justify-evenly">
    <q-card flat bordered>
      <q-item>
        <q-item-section>
          <q-item-label>Password Reset</q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-card-section>
        Create a new password
      </q-card-section>

      <q-separator />

      <q-card-section>
        Form Form Form
      </q-card-section>

      <q-separator />

      <q-card-section>
        <q-card-actions align="around">
          <q-btn flat to="/login">Save</q-btn>
        </q-card-actions>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'ResetPasswordPage',
  components: { },
  setup () {
    return { }
  }
})
</script>
