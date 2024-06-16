<script charset="utf-8">
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret, faUser, faLock } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faUserSecret)
library.add(faUser)
library.add(faLock)

Vue.component('font-awesome-icon', FontAwesomeIcon)
<script>

<template>
  <div class="form__group" :class="{'active': inputFocus}">
    <label :for="type">{{ label }}</label>
    <font-awesome-icon :icon="['fas',icon]"/>
    <input @focusin="inputFocus = true" @focusout="inputFocus = false" :type="type" :name="type" :id="type">
  </div>
</template>
