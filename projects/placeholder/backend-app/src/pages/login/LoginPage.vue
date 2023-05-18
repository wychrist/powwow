<template>
  <q-page class="row items-center justify-evenly">
    <login-form-card></login-form-card>
  </q-page>
</template>

<script lang="ts">
import LoginFormCard from 'src/components/login/LoginFormCard.vue'
// import LoginForm from 'src/components/login/LoginForm.vue'
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'LoginPage',
  components: { LoginFormCard },
  setup () {
    const email = ref('')
    const password = ref('')
    const isPwd = ref(true)

    return {
      email,
      password,
      isPwd
    }
  }
})
</script>
