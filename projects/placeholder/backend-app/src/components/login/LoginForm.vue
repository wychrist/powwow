<template>
      <form>
        <q-item>
          <q-card-section class="full-width">
            <q-input
              v-model="username"
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
              :type="makeVisible ? 'text': 'password'"
              :rules="passwordRules"
              required
              >
              <template v-slot:append>
                <q-icon
                  :name="makeVisible? 'visibility_off': 'visibility'"
                  class="cursor-pointer"
                  @click="() => makeVisible = !makeVisible"
                />
              </template>
            </q-input>
          </q-card-section>
        </q-item>

        <q-separator color="grey" />
        <q-card-section>
          <q-card-actions align="right">
            <q-btn color="primary" type="submit" @click="doLogin">Sign-in</q-btn>
          </q-card-actions>
        </q-card-section>
      </form>

</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useLogin } from 'src/composibles/login_composible'
import { validateEmail, validateNotEmpty } from 'src/composibles/validate_composible'

export default defineComponent({
  name: 'LoginForm',
  setup () {
    const { username, password, doLogin } = useLogin()
    const makeVisible = ref(false)

    return {
      password,
      username,
      makeVisible,
      emailRules: [validateEmail('Field is required')],
      passwordRules: [validateNotEmpty('Field is required')],
      doLogin
    }
  }
})
</script>
