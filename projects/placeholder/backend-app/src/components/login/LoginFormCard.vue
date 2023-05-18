<template>
    <q-card>
      <q-item align="center" class="bg-primary text-white">
        <q-item-section>
          <h1 class="text-h5 q-mt-sm q-mb-xs">{{ title  }}</h1>
        </q-item-section>
      </q-item>
          <slot>
            <login-form></login-form>
          </slot>
        <q-item>
          <router-link to="/register">Register</router-link>
          <span class="q-px-md"></span>
          <router-link to="/forgot-password">Forgotten your password?</router-link>
        </q-item>

    </q-card>
</template>

<script lang="ts">
import { PropType, defineComponent } from 'vue'
import LoginForm from 'src/components/login/LoginForm.vue'

export default defineComponent({
  name: 'LoginFormCard',
  props: {
    title: {
      type: String as PropType<string>,
      default: 'Login'
    }
  },
  components: {
    LoginForm
  },
  setup () {
    return {}
  }
})
</script>
