<template>
  <q-page class="row items-center justify-evenly">
    <q-card flat bordered>
      <q-item>
        <q-item-section>
          <q-item-label>Forgotten your password?</q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />
      <q-item v-if="emailSent">
        <q-card-section>
          A link will be sent to your email inbox shortly. Please check your spam folder if you do not receive the link
        </q-card-section>

        <q-separator />

        <q-card-section>
          <q-card-actions align="right">
            <q-btn flat to="reset-password">Request Reset</q-btn>
            <q-btn flat to="login">Back to Login</q-btn>
          </q-card-actions>
        </q-card-section>
      </q-item>

      <div v-else>
        <q-item>
          <q-card-section>
            Fill in you email to receive a password reset link
          </q-card-section>
        </q-item>

        <q-item>
          <q-card-section>
            Email form
          </q-card-section>
        </q-item>

        <q-separator />

        <q-item>
          <q-card-section>
            <q-card-actions align="around">
              <q-btn flat @click="sendEmail">Request Reset</q-btn>
            </q-card-actions>
          </q-card-section>
      </q-item>
      </div>

    </q-card>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'ForgotPasswordPage',
  components: {},
  data () {
    return {
      emailSent: ref(false)
    }
  },
  methods: {
    sendEmail () {
      this.emailSent = true
    }
  },
  setup () {
    return {}
  }
})
</script>
