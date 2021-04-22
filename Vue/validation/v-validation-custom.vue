<template>
  <div class="container">
    <form class="pt-3">
      <div class="form-group">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            class="form-control"
            :class="{'is-invalid': $v.email.$error}"
            v-model="email"
            @input="$v.email.$touch()"
        >
      </div>
      <div class="invalid-feedback" v-if="!$v.email.required">Email field is required</div>
      <div class="invalid-feedback" v-if="!$v.email.email">Please provide a valid email.</div>
      <div class="invalid-feedback" v-if="!$v.email.uniqueEmail">Enter another email</div>
    </form>
  </div>
</template>

<script>
import {required, email} from 'vuelidate/lib/validators'

export default {
  data() {
    return {
      email: '',
    }
  },
  validations: {
    email: {
      required,
      email,
      uniqueEmail: (newEmail) => {
        if (newEmail === '') {
          return true;
        }
        return new Promise((resolve) => {
          setTimeout(() => {
            const value = (newEmail !== 'test@mail.ru');
            resolve(value);
          }, 3000);
        });
      }
    }
  }
}
</script>

<style>
.invalid-feedback {
  display: block;
}
</style>
