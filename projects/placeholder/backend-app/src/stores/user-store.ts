import { defineStore } from 'pinia'
import { readonly, ref } from 'vue'
import { useAuthStore } from './auth-store'

export interface IUser {
  email: string,
  name: string,
  created_at: string,
  updated_at: string
}

function makeUser (): IUser {
  return {
    email: '',
    name: '',
    created_at: '',
    updated_at: ''
  }
}

export const useUserStore = defineStore('user-store', () => {
  const user = ref<IUser>(makeUser())
  const auth = useAuthStore()

  async function fetchMe () {
    const response = await auth.http.get('/api/v1/me')
    console.log('response for me', response)
  }

  return {
    user: readonly(user),
    fetchMe
  }
})
