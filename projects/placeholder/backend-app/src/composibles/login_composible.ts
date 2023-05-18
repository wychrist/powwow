import { useAuthStore } from 'src/stores/auth-store'
import { computed, readonly, ref } from 'vue'

const username = ref('')
const password = ref('')
const isUsernameValid = ref(true)
const isPasswordValid = ref(true)
const authStore = useAuthStore()

export const doLogin = async () => {
  // validate the data first
  if (username.value.length < 10) {
    isUsernameValid.value = false
    return false
  }

  return await authStore.login(username.value, password.value)
}

export function useLogin () {
  return {
    isPasswordValid: readonly(isPasswordValid),
    isUsernameValid: readonly(isUsernameValid),
    doLogin,
    username: computed({
      get: () => username.value,
      set: (v: string) => {
        // is actually an email
        username.value = v
      }
    }),
    password: computed({
      get: () => password.value,
      set: (v: string) => {
        // is actually an password.
        password.value = v
      }
    })
  }
}
