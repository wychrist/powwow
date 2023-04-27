import axios from 'axios'
import { defineStore } from 'pinia'

/**
 * Authentication store
 *
 * This store is use for user authentication
 */
export const useAuthStore = defineStore('auth-store', {
  state: () => ({
    loginState: {
      isLogin: false
    },
    apiClient: axios
  }),
  getters: {

    /**
     * Returns the login state of the current user
     *
     * @returns boolean
     */
    isLogin: (state) => {
      return state.loginState.isLogin
    },

    /**
     * Http client for API request
     *
     * @returns Axios
     */
    http: (state) => {
      return state.apiClient
    }
  },
  actions: {

    async check (): Promise<{ success: boolean }> {
      await this.http.get('/sanctum/csrf-cookie')
      const response = await this.http.get('/api-check')
      const data = response.data as { success: boolean }

      this.$state.loginState.isLogin = data.success
      return data
    },

    /**
     * Try logging in the user with the specified credentials
     *
     * @returns
     */
    async login (email: string, password: string) {
      if (this.isLogin) {
        return true
      }

      try {
        const response = await this.http.post('/api-login', { email, password })
        const payload: { success: boolean } = response.data
        this.$state.loginState.isLogin = payload.success
        return true
      } catch (e) {
        return false
      }
    },
    async logout () {
      if (!this.isLogin) {
        return true
      }
      try {
        const response = this.http.post('/api-logout')
        return true
      } catch (e) {
        return false
      }
    }
  }
})
