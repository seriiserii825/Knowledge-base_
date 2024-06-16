<script setup lang="ts">
const email_field = ref<any>('');
const password_field = ref<any>('');
const checkbox_is_active = ref(false);


watch(checkbox_is_active, (value) => {
  setRememberLocalStorage();
});

function setRememberLocalStorage() {
  if (checkbox_is_active.value && email_field.value !== "") {
    localStorage.silcompa_username = email_field.value;
    localStorage.silcompa_password = password_field.value;
    localStorage.silcompa_checkbox = checkbox_is_active.value;
  } else {
    localStorage.silcompa_username = "";
    localStorage.silcompa_password = "";
    localStorage.silcompa_checkbox = "";
  }
}

function checkRememberLocalStorage(){
  if (localStorage.silcompa_checkbox && localStorage.silcompa_checkbox !== false) {
    checkbox_is_active.value = true;
    email_field.value = localStorage.silcompa_username;
    password_field.value = localStorage.silcompa_password;
  } else {
    checkbox_is_active.value = false;
    email_field.value = "";
    password_field.value = "";
  }
}

onMounted(() => {
  checkRememberLocalStorage();
});
</script>

<template>
  <div class="login disable-select">
    <Auth>
      <Form :title="t('login.title')" :language="true">
        <div class="mb-24">
          <FormBlock>
            <Input
                id="email"
                :placeholder="t('login.placeholders.email')"
                v-model:value="$v.email_field.$model"
                :input_dark_bg="true"
                :input_dark_color="true"
                :border-bottom="true"
            />
            <Input
                id="password"
                placeholder="Password"
                type="password"
                v-model:value="$v.password_field.$model"
                :errors="$v.password_field.$errors"
            />
          </FormBlock>
        </div>
        <div class="login__privacy">
          <CheckboxCustom
              :label="t('login.remember_me')"
              name="ricordami"
              id="ricordami"
              v-model:checked="checkbox_is_active"/>
          <router-link class="login__link" :to="E_Router.RESET_PASSWORD">{{ t('login.reset_password') }}</router-link>
        </div>
      </Form>
    </Auth>
  </div>
</template>
