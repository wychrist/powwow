import { computed, readonly, ref } from 'vue'

const username = ref('')
const password = ref('')
const isUsernameValid = ref(true)
const isPasswordValid = ref(true)

export const doLogin = () => {
  // validate the data first
  if (username.value.length < 10) {
    isUsernameValid.value = false
    return
  }
  console.log('logging in', {
    username: username.value,
    password: password.value
  })
}

export function useLogin () {
  return {
    isPasswordValid: readonly(isPasswordValid),
    isUsernameValid: readonly(isUsernameValid),
    doLogin,
    username: computed({
      get: () => username.value,
      set: (v: string) => {
        // is actually an email. ldldld
        username.value = v
      }
    }),
    password: computed({
      get: () => password.value,
      set: (v: string) => {
        // is actually an email. ldldld
        password.value = v
      }
    })
  }
}
