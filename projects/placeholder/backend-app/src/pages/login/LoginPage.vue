<template>
  <q-page class="row items-center justify-evenly">
    <q-card >
      <q-item align="center" class="bg-primary text-white">
        <q-item-section>
          <h1 class="text-h5 q-mt-sm q-mb-xs">Login</h1>
        </q-item-section>
      </q-item>

      <form>
        <q-item>
          <q-card-section class="full-width">
            <q-input
              v-model="email"
              label="Email"
              name="email"
              placeholder="doe.j@example.com"
              :rules="emailRules"
              type="email"
              required
            />
            <q-input
              v-model="password"
              label="Password"
              name="password"
              placeholder="password"
              maxlength="20"
              :type="isPwd ? 'password' : 'text'"
              :rules="passwordRules"
              required
              >
              <template v-slot:append>
                <q-icon
                  :name="isPwd ? 'visibility_off' : 'visibility'"
                  class="cursor-pointer"
                  @click="isPwd = !isPwd"
                />
              </template>
            </q-input>
          </q-card-section>
        </q-item>

        <q-separator color="grey"/>

        <q-card-section>
          <q-card-actions align="right">
            <q-btn color="primary" type="submit">Sign-in</q-btn>
          </q-card-actions>
        </q-card-section>
      </form>

        <q-item>
          <router-link to="/register">Register</router-link>
          <span class="q-px-md"></span>
          <router-link to="/forgot-password">Forgotten your password?</router-link>
        </q-item>

    </q-card>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'LoginPage',
  components: {},
  data () {
    return {
      email: ref(''),
      password: ref(''),
      isPwd: ref(true)

    }
  },
  setup () {
    return {
      emailRules: [(val, rules) => rules.email(val) || 'Field is required'],
      passwordRules: [val => !!val || 'Field is required']
    }
  }
})
</script>
