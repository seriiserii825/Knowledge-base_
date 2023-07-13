<template>
  <div class="login">
    <div class="login__form">
      <Form @submit.native.prevent="onSubmitForm">
        <h2 class="form__title" slot="title">Registration form</h2>
        <div class="form__group form__group--has-icon" :class="{'active': inputEmailFocus, 'invalid': emailInvalid}" slot="form-group-1">
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

        <div class="form__group form__group--has-icon" :class="{'active': inputPasswordFocus, 'invalid': passwordInvalid}" slot="form-group-2">
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
          <p class="field-error" v-if="!$v.password.minLength">Min length of password is {{ $v.password.$params.minLength.min }}</p>
        </div>

        <div class="form__group form__group--has-icon" :class="{'active': inputConfirmPasswordFocus, 'invalid': confirmPasswordInvalid}" slot="form-group-3">
          <label :for="confirmPassword">Confirm password</label>
          <font-awesome-icon :icon="['fas','lock']"/>
          <input
            @focusin="onInputFocus('inputConfirmPasswordFocus', 'confirmPasswordInvalid')"
            @focusout="checkInputFocus($event, 'inputEmailFocus')"
            id="confirmPassword"
            type="password"
            v-model="confirmPassword"
            @input="$v.confirmPassword.$touch()"
          >
          <p class="field-error" v-if="confirmPasswordInvalid">This field is required</p>
          <p class="field-error" v-if="!$v.confirmPassword.minLength">Min length of password is {{ $v.confirmPassword.$params.minLength.min }}</p>
          <p class="field-error" v-else-if="!$v.confirmPassword.sameAs">Passwords input must match</p>
        </div>
        <Button type="submit" label="Login" slot="submit" :class="{'btn--loading': loading}"></Button>
      </Form>
    </div>
  </div>
</template>

<script>
import Form from '@/components/form/Form'
import Button from '@/components/ui/Button'
import {required, email, minLength, sameAs} from 'vuelidate/lib/validators'
import loading from '@/mixins/mixin-loading'

export default {
  data () {
    return {
      email: '',
      password: '',
      confirmPassword: '',
      inputEmailFocus: false,
      inputPasswordFocus: false,
      inputConfirmPasswordFocus: false,
      emailInvalid: false,
      passwordInvalid: false,
      confirmPasswordInvalid: false
    }
  },
  mixins: [loading],
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
      }
      if (!this.$v.password.required) {
        this.passwordInvalid = true
      }
      if (!this.$v.confirmPassword.required) {
        this.confirmPasswordInvalid = true
      }
      const user = {
        email: this.email,
        password: this.password
      }
      if (this.$v.email.required && this.$v.password.required && this.$v.confirmPassword.required) {
        this.$store.dispatch('registerUser', user)
          .then(() => {
            this.$router.push('/')
          })
          .catch(err => console.log(err))
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
      required,
      minLength: minLength(8)
    },
    confirmPassword: {
      required,
      minLength: minLength(8),
      sameAs: sameAs('password')
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
