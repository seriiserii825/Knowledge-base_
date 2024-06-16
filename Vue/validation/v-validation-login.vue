#========== main.js
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
#========== main.js

<template>
  <div class="login">
    <div class="login__form">
      <Form @submit.native.prevent="onSubmitForm">
        <h2 class="form__title" slot="title">Form login</h2>
        <div class="form__group" :class="{'active': inputEmailFocus, 'invalid': emailInvalid}" slot="form-group-1">
          <label :for="email">Email</label>
          <font-awesome-icon :icon="['fas','user']"/>
          <input
              @input="$v.email.$touch()"
              @focusin="onInputFocus('inputEmailFocus', 'emailInvalid')"
              @focusout="checkInputFocus($event, 'inputEmailFocus')"
              type="email" id="email"
              v-model="email"
          >
          <p class="field-error" v-if="emailInvalid">This field is required</p>
          <p class="field-error" v-if="!$v.email.email">Enter valid email</p>
        </div>

        <div class="form__group" :class="{'active': inputPasswordFocus, 'invalid': passwordInvalid}" slot="form-group-2">
          <label :for="password">Password</label>
          <font-awesome-icon
              :icon="['fas','lock']"
          />
          <input
              @focusin="onInputFocus('inputPasswordFocus', 'passwordInvalid')"
              @focusout="checkInputFocus($event, 'inputEmailFocus')"
              v-model="password"
              type="password"
              id="password"
          >
          <p class="field-error" v-if="passwordInvalid">This field is required</p>
        </div>
        <Button type="submit" label="Login" slot="submit"></Button>
      </Form>
    </div>
  </div>
</template>

<script>
import Form from '@/components/form/Form'
import Button from '@/components/ui/Button'
import { required, email } from 'vuelidate/lib/validators'

export default {
  data () {
    return {
      email: '',
      password: '',
      inputEmailFocus: false,
      inputPasswordFocus: false,
      emailInvalid: false,
      passwordInvalid: false
    }
  },
  components: {
    Form,
    Button
  },
  methods: {
    checkInputFocus (e, input) {
      if (e.target.value === '') {
        this[input] = false
      }
    },
    onSubmitForm () {
      if (!this.$v.email.required) {
        this.emailInvalid = true
        this.passwordInvalid = true
      } else {
        console.log(this.email)
        console.log(this.password)
      }
    },
    onInputFocus (inputFocus, inputInvalid) {
      this[inputFocus] = true
      this[inputInvalid] = false
    }
  },

  validations: {
    email: {
      required,
      email
    },
    password: {
      required
    }
  }
}
</script>

<style lang="scss">
.login {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 70vh;
}
</style>
