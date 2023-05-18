<template>
  <q-page class="row items-center justify-evenly">
    <q-card>
      <q-item align="center" class="bg-primary text-white">
        <q-item-section>
          <h1 class="text-h5 q-mt-sm q-mb-xs">Forgotten Passord</h1>
        </q-item-section>
      </q-item>

      <q-separator />
      <div v-if="emailSent">
        <q-item >
          <q-card-section>
            A link will be sent to the email address inbox shortly. Please check your spam folder if you do not receive the link.
          </q-card-section>
        </q-item>

        <q-separator />

        <q-card-section>
          <q-card-actions align="around">
            <q-btn flat to="reset-password">Request Reset</q-btn>
            <q-btn color="primary" to="login">Back to Login</q-btn>
          </q-card-actions>
        </q-card-section>
      </div>

      <div v-else>
        <q-item>
          <q-card-section>
            Fill in you email to receive a password reset link
          </q-card-section>
        </q-item>

        <form>
          <q-item>
            <q-card-section class="full-width">
              <q-input
                  v-model="email"
                  name="email"
                  ref="emailRef"
                  label="Email"
                  placeholder="doe.j@example.com"
                  :rules="emailRules"
                  type="email"
                  required
                />
            </q-card-section>
          </q-item>

          <q-separator color="grey"/>

          <q-card-section>
            <q-card-actions align="around">
              <q-btn color="primary" @click="sendEmail">Request Reset</q-btn>
            </q-card-actions>
          </q-card-section>
        </form>
      </div>

    </q-card>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'ForgotPasswordPage',
  components: {},
  setup () {
    const email = ref('')
    const emailRef = ref(null)
    const emailSent = ref(false)
    return {
      email,
      emailRef,
      emailSent,
      emailRules: [(val, rules) => rules.email(val) || 'A valid email address is required'],

      sendEmail () {
        emailRef.value.validate()
        if (!emailRef.value.hasError) {
          emailSent.value = true
        }
      }
    }
  }
})
</script>
