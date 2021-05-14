//npm install vee-validate --save

# plugins/vee-validate.js

import {extend} from "vee-validate";
import {required, email} from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "This field is required"
});
// extend("email", {
//   ...email,
//   message: "This field is email"
// });


#nuxt.config.js

  plugins: ["~/plugins/vee-validate.js"],

  build: {
    transpile: ["vee-validate/dist/rules"],
  }

#component

<template>
  <ValidationObserver ref="observer"
                      v-slot="{ invalid }"
                      class="form"
                      tag="form"
                      @submit.prevent="onSubmit">
    <h3 class="form__title">Add you comment:</h3>
    <ValidationProvider v-slot="{ errors }"
                        class="form-group"
                        rules="required">
      <label for="username">Your name</label>

      <input id="username"
             v-model="username"
             :class="{'error': errors[0]}"
             type="text">
      <span>{{ errors[0] }}</span>
    </ValidationProvider>
    <ValidationProvider v-slot="{ errors }"
                        class="form-group"
                        rules="required">

      <label for="message">Your message</label>
      <textarea id="message"
                v-model="message"
                :class="{'error': errors[0]}"
                name="message"></textarea>

      <span>{{ errors[0] }}</span>
    </ValidationProvider>
    <input :disabled="invalid"
           type="submit"
           value="Add comment"/>
  </ValidationObserver>
</template>
<script>
import {ValidationObserver, ValidationProvider} from "vee-validate";

export default {
  data() {
    return {
      username: '',
      message: ''
    }
  },
  components: {
    ValidationObserver: ValidationObserver,
    ValidationProvider: ValidationProvider
  },
  methods: {
    onSubmit() {
      const valid = this.$refs.observer.validate();
      if (valid) {
        this.$refs.observer.reset();
      } else {
        console.log('not valid')
      }
    }
  }
};
</script>
<style lang="stylus"
       scoped>
.form
  padding 3rem
  border 1px solid #e6e6e6
  box-shadow 0 4px 8px rgba(0, 0, 0, .1)

  &__title
    margin-bottom 4rem

.form-group
  display block
  margin-bottom 4rem

  span
    font-size: 1.2rem
    color red

label
  display block
  margin-bottom 1rem
  font-weight bold

input[type="text"],
input[type="email"]
  width 100%
  height 5rem
  text-indent 0.8rem
  border 1px solid #e6e6e6
  border-radius 0.5rem
  transition all .6s

  &.error
    border-color red

  &:focus
    border-color #aaa

textarea
  padding: 1rem 0.8rem
  width 100%
  height 15rem
  border 1px solid #e6e6e6
  border-radius 0.5rem

  &.error
    border-color red

  &:focus
    border-color #aaa

input[type="submit"]
  display inline-block
  padding 1.5rem 2rem
  color white
  background-color maroon
  border-radius 0.3rem
  border none
  cursor pointer
  transition all .4s

  &:hover
    background-color darken(maroon, 20%)
</style>


