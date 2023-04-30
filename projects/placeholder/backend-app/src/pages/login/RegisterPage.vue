<template>
  <q-page class="row items-center justify-evenly">
    <q-card flat bordered>
      <q-item align="center" class="bg-primary text-white">
        <q-item-section>
          <h1 class="text-h5 q-mt-sm q-mb-xs">Register</h1>
        </q-item-section>
      </q-item>

      <q-card-section>
        Fill in your details and accept the privacy policy to register
      </q-card-section>

      <q-separator inset color="grey"/>

      <form>
        <q-item>
          <q-card-section>
              <q-input
                  v-model="name"
                  name="name"
                  ref="nameRef"
                  label="Full Name"
                  placeholder="John Doe"
                  :rules="nameRules"
                  type="text"
                  required
                />
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
              <q-input
                  v-model="password"
                  name="password"
                  ref="passwordRef"
                  label="Password"
                  placeholder="password"
                  maxlength="20"
                  :type="isPwd ? 'password' : 'text'"
                  :error-message="passwordErrorMsg"
                  :error="!ispasswordValid"
                  :rules="[ ValidPass1]"
                  required
                  counter
                  :class="passGoodClass"
                >
                  <template v-slot:append>
                    <q-icon
                      :name="isPwd ? 'visibility_off' : 'visibility'"
                      class="cursor-pointer"
                      @click="isPwd = !isPwd"
                    />
                  </template>
                </q-input>
              <q-input
                  v-model="password2"
                  name="password2"
                  ref="password2Ref"
                  label="Retype Password"
                  placeholder="password"
                  maxlength="20"
                  :type="isPwd ? 'password' : 'text'"
                  :error="!ispassword2Valid"
                  :rules="[ ValidPass2 ]"
                  required
                  counter
                  :class="passGoodClass"
                >
                  <template v-slot:append>
                    <q-icon
                      :name="isPwd ? 'visibility_off' : 'visibility'"
                      class="cursor-pointer"
                      @click="isPwd = !isPwd"
                    />
                  </template>
                </q-input>
              <q-toggle
                  v-model="accept"
                  name="privacyPolicy"
                  label="I accept the terms, conditions and  ">
                <a href="#" target="_blank">privacy policy</a>
              </q-toggle>

          </q-card-section>
        </q-item>

        <q-separator color="grey"/>

        <q-card-section>
          <q-card-actions align="around">
            <q-btn flat to="/">Cancel</q-btn>
            <q-btn color="primary" @click="onSubmit">Sign-up</q-btn>
          </q-card-actions>
        </q-card-section>
      </form>
    </q-card>
  </q-page>
</template>

<script lang="ts">
import { useQuasar } from 'quasar'
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'RegisterPage',
  components: {},
  setup () {
    const $q = useQuasar()

    const accept = ref(false)

    const isPwd = ref(true)

    const name = ref('')
    const nameRef = ref(null)

    const email = ref('')
    const emailRef = ref(null)

    const password = ref('')
    const passwordRef = ref(null)
    const ispasswordValid = ref(true)
    const passwordErrorMsg = ref('')

    const password2 = ref('')
    const password2Ref = ref(null)
    const ispassword2Valid = ref(true)
    const password2ErrorMsg = ref('')

    const passGoodClass = ref('')

    function validatePasswords (val) {
      let errorMessage = /(?=.*?[A-Z])/.test(val) ? '' : '1 Uppercase, '
      errorMessage = errorMessage.concat(/(?=.*?[a-z])/.test(val) ? '' : '1 Lowercase, ')
      errorMessage = errorMessage.concat(/(?=.*?[0-9])/.test(val) ? '' : '1 Number, ')
      errorMessage = errorMessage.concat(/(?=.*?[#?!@$ ()`~_%^&*-])/.test(val) ? '' : '1 Special Character, ')
      errorMessage = errorMessage.concat(/.{8,}/.test(val) ? '' : 'min. 8 long')

      return (errorMessage.length !== 0) ? errorMessage : true
    }

    return {
      accept,
      isPwd,

      name,
      nameRef,
      nameRules: [val => (val && val.length > 2) || 'Everybody has a name, why not share it? (min. 3 characters)'],

      email,
      emailRef,
      emailRules: [(val, rules) => rules.email(val) || 'A valid email address is required to have an account'],

      password,
      passwordRef,
      ispasswordValid,
      passwordErrorMsg,

      password2,
      password2Ref,
      ispassword2Valid,
      password2ErrorMsg,

      passGoodClass,
      // passwordRules: [val => /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ _%^&*-]).{8,}$/.test(val) || 'Needs to have at least 1 Uppercase, 1 Lowercase, 1 number, min 8 characters long.'],

      ValidPass1 (val) {
        const errorMessage = validatePasswords(val)

        // check if password field was invalid
        if (errorMessage !== true) { // Field not valid
          passGoodClass.value = '' // remove 'good' class from both fields
          return errorMessage
        } else if (password.value === password2.value) { // Password match
          passGoodClass.value = 'pass-good' // Add 'good' class for both fields
        }
        return true
      },
      ValidPass2 (val) {
        const errorMessage = validatePasswords(val)

        // check if password field was invalid
        if (errorMessage !== true) { // Field not valid
          passGoodClass.value = '' // remove 'good' class from both fields
          console.log('error')
          return errorMessage
        } else if (password.value === password2.value) { // Password match
          console.log('match')
          passGoodClass.value = 'pass-good' // Add 'good' class for both fields
          return true
        } else { // valid, but no match
          console.log('no match')
          passGoodClass.value = '' // remove 'good' class from both fields
          return 'Passwords Don\'t match'
        }
      },
      onSubmit () {
        nameRef.value.validate()
        emailRef.value.validate()
        passwordRef.value.validate()
        password2Ref.value.validate()
        const isPasswordsValid = (password.value === password2.value)

        if (nameRef.value.hasError || emailRef.value.hasError || passwordRef.value.hasError || password2Ref.value.hasError) {
          // form has error
        } else if (!isPasswordsValid) {
          $q.notify({
            color: 'negative',
            message: 'The passwords do not match'
          })
        } else if (accept.value !== true) {
          $q.notify({
            color: 'negative',
            message: 'You need to accept the license and terms first'
          })
        } else {
          $q.notify({
            icon: 'done',
            color: 'positive',
            message: 'Submitted'
          })
        }
      }
    }
  }
})
</script>

<style>
.pass-good .q-field__inner {
  background-color: rgb(150, 210, 150);
}
</style>
