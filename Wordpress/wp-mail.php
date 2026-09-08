<?php
// create file js/contact-form.js
wp_enqueue_script('contact-form', get_template_directory_uri() . '/js/contact-form.js', ['jquery'], null, true);
wp_localize_script('contact-form', 'my_ajax_object', [
  'ajax_url' => admin_url('admin-ajax.php'),
  'nonce'    => wp_create_nonce('my_nonce')
]);


add_action('wp_ajax_send_contact_email', 'handle_send_contact_email');
add_action('wp_ajax_nopriv_send_contact_email', 'handle_send_contact_email');


function handle_send_contact_email()
{
  check_ajax_referer('my_nonce', 'security');

  $name    = sanitize_text_field($_POST['name']);
  $surname  = sanitize_text_field($_POST['surname']);
  $immobile = sanitize_text_field($_POST['immobile']);
  $phone   = sanitize_text_field($_POST['phone']);
  $email   = sanitize_email($_POST['email']);
  $subject = sanitize_text_field($_POST['subject']);
  $message = sanitize_textarea_field($_POST['message']);

  $to      = get_option('admin_email');
  $subject = "Contact Form Submission: $subject";
  $headers = ['Content-Type: text/html; charset=UTF-8', "Reply-To: $name <$email>"];
  $bcc = "sergiu@bludelego.it";
  $headers[] = "Bcc: $bcc";
  $body   = "<p><strong>Nome:</strong> $name</p>";
  $body  .= "<p><strong>Cognome:</strong> $surname</p>";
  $body  .= "<p><strong>Immobile:</strong> $immobile</p>";
  $body  .= "<p><strong>Telefono:</strong> $phone</p>";
  $body  .= "<p><strong>Email:</strong> $email</p>";
  $body  .= "<p><strong>Messaggio:</strong></p>";
  $body  .= "<p>$message</p>";

  $sent = wp_mail($to, $subject, $body, $headers);
  $sent = wp_mail($email, $subject, $body, $headers);

  if ($sent) {
    wp_send_json_success('Message sent successfully!');
  } else {
    wp_send_json_error('Failed to send email.');
  }

  wp_die(); // important for AJAX
}?>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import ISubmit from "../../icons/ISubmit.vue";
import axios from "axios";
import Loader from "../Loader.vue";
const props = defineProps({
  codice: {
    type: String,
    required: true,
  },
});
const checked = ref(false);
const loading = ref(false);
const first_click = ref(false);
const error_message = ref("È richiesto il campo");
const error_email = ref("Email non valida");
const show_success_message = ref(false);
const success_message = ref("Messaggio inviato con successo");
const form = ref({
  name: "",
  surname: "",
  immobile: "",
  phone: "",
  email: "",
  subject: "",
  message: "",
});

function validateFields() {
  const { name, surname, immobile, phone, email, subject, message } = form.value;
  return (
    name.trim() !== "" &&
    surname.trim() !== "" &&
    immobile.trim() !== "" &&
    phone.trim() !== "" &&
    email.trim() !== "" &&
    subject.trim() !== "" &&
    message.trim() !== ""
  );
}

function validateEmail(email: string) {
  const re =
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function resetForm() {
  form.value.name = "";
  form.value.surname = "";
  form.value.immobile = "";
  form.value.phone = "";
  form.value.email = "";
  form.value.subject = "";
  form.value.message = "";
  checked.value = false;
  first_click.value = false;
}

onMounted(() => {
  form.value.immobile = props.codice;
});

async function onSubmit() {
  if (checked.value) {
    first_click.value = true;
    if (validateFields()) {
      loading.value = true;
      try {
        const formData = new FormData();
        formData.append("action", "send_contact_email");
        formData.append("security", my_ajax_object.nonce);
        formData.append("name", form.value.name);
        formData.append("surname", form.value.surname);
        formData.append("immobile", form.value.immobile);
        formData.append("phone", form.value.phone);
        formData.append("email", form.value.email);
        formData.append("subject", form.value.subject);
        formData.append("message", form.value.message);

        const response = await axios.post(my_ajax_object.ajax_url, formData, {
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
        });
        setTimeout(() => {
          loading.value = false;
          show_success_message.value = true;
          resetForm();
          setTimeout(() => {
            show_success_message.value = false;
          }, 6000);
        }, 400);
        console.log(response, "response");
      } catch (error) {
        console.log(error, "error");
        loading.value = false;
      }
    }
  }
}
</script>
<template>
  <div class="add-form">
    <h2 class="add-form__title">Richiedi informazioni</h2>
    <div class="add-form__body">
      <div class="add-form__row">
        <div class="add-form__group">
          <input type="text" v-model="form.name" placeholder="Nome*" class="add-form__input" />
          <span class="add-form__error" v-if="form.name == '' && first_click">{{
            error_message
          }}</span>
        </div>
        <div class="add-form__group">
          <input
            type="text"
            v-model="form.surname"
            placeholder="Cognome*"
            class="add-form__input"
          />
          <span class="add-form__error" v-if="form.surname == '' && first_click">{{
            error_message
          }}</span>
        </div>
      </div>
      <div class="add-form__group">
        <input
          type="text"
          v-model="form.immobile"
          placeholder="Immobile*"
          class="add-form__input"
          :disabled="true"
        />
        <span class="add-form__error" v-if="form.immobile == '' && first_click">{{
          error_message
        }}</span>
      </div>
      <div class="add-form__group">
        <input type="text" v-model="form.phone" placeholder="Telefono*" class="add-form__input" />
        <span class="add-form__error" v-if="form.phone == '' && first_click">{{
          error_message
        }}</span>
      </div>
      <div class="add-form__group">
        <input type="email" v-model="form.email" placeholder="Email*" class="add-form__input" />
        <span class="add-form__error" v-if="form.email == '' && first_click">{{
          error_message
        }}</span>
        <span class="add-form__error" v-if="form.email !== '' && !validateEmail(form.email)">{{
          error_email
        }}</span>
      </div>
      <div class="add-form__group">
        <input type="text" v-model="form.subject" placeholder="Oggetto*" class="add-form__input" />
        <span class="add-form__error" v-if="form.subject == '' && first_click">{{
          error_message
        }}</span>
      </div>
      <div class="add-form__group">
        <textarea
          v-model="form.message"
          placeholder="Messaggio*"
          class="add-form__textarea"
        ></textarea>
        <span class="add-form__error" v-if="form.message == '' && first_click">{{
          error_message
        }}</span>
      </div>
      <div class="add-form__privacy">
        <input v-model="checked" type="checkbox" id="privacy" class="add-form__checkbox" />
        <label for="privacy" class="add-form__privacy-label">
          <p>
            Cliccando su invia dichiari di aver preso visione e di accettare la nostra <a
              href="/privacy-policy"
              target="_blank"
              >privacy policy</a
            >
          </p>
        </label>
      </div>
      <Loader v-if="loading" />
      <button @click="onSubmit" :disabled="!checked" class="add-form__submit">
        <span>Invia</span>
        <ISubmit />
      </button>
      <div class="add-form__success" v-if="show_success_message">
        {{ success_message }}
      </div>
    </div>
  </div>
</template>
