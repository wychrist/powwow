import { LocalStorage } from 'quasar'

export const Model = {
  isSetup(): boolean {
    return LocalStorage.has('setup_completed')
  }
}
