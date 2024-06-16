<template>
  <div class="container">
    <h1>Hello world</h1>
    <form @submit.prevent="onSubmit">
      <div class="form-group">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            class="form-control"
            :class="{'is-invalid': $v.email.$error}"
            @input="$v.email.$touch()"
            v-model="email"
        >
        <div class="invalid-feedback" v-if="!$v.email.required">This field is required</div>
        <div class="invalid-feedback" v-if="!$v.email.email">This field is email</div>
        <div class="invalid-feedback" v-if="!$v.email.uniqEmail">This email is already exists</div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            class="form-control"
            :class="{'is-invalid': $v.password.$error}"
            @input="$v.password.$touch()"
            v-model="password"
        >
        <div class="invalid-feedback" v-if="!$v.password.minLength">
          Min length of password is {{ $v.password.$params.minLength.min }}. Now it is {{ password.length }}
        </div>
      </div>

      <div class="form-group">
        <label for="password">Confirm password</label>
        <input
            type="password"
            id="confirmPassword"
            class="form-control"
            :class="{'is-invalid': $v.confirmPassword.$error}"
            @input="$v.confirmPassword.$touch()"
            v-model="confirmPassword"
        >
        <div class="invalid-feedback" v-if="!$v.confirmPassword.minLength">
          Password should match
        </div>
      </div>
      <button
          type="submit"
          class="btn btn-success"
          :disabled="$v.$invalid"
      >Submit</button>
    </form>
  </div>
</template>

<script>
import {required, email, minLength, sameAs} from 'vuelidate/lib/validators'

export default {
  name: 'app',
  data() {
    return {
      form: {
        password: ''
      },
      email: '',
      password: '',
      confirmPassword: ''
    }
  },
  methods: {
    onSubmit(){
      console.log('Email', this.email);
      console.log('Password', this.password);
    }
  },
  validations: {
    email: {
      required,
      email,
      uniqEmail: function (newEmail) {
        return newEmail !== 'test@mail.ru'
      }
    },
    password: {
      minLength: minLength(6)
    },
    confirmPassword: {
      sameAs: sameAs('password')
      // sameAs: sameAs((vue) => {
      //   return vue.form.password
      // })
    }
  }
}
</script>
