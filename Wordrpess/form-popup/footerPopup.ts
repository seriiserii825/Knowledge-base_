export default function footerPopup() {
  const send_form_input = document.querySelector(".send-email input");
  const send_form_btn = document.querySelector(".send-email button");
  const footer_popup = document.querySelector(".footer-popup");
  const form_email = footer_popup?.querySelector("form input[type='email']");
  const popup_close = document.querySelector(".footer-popup__close");
  const send_email_error = document.querySelector(".send-email__error");

  document.addEventListener("click", (e) => {
    if (e.target === footer_popup) {
      closePopup();
    }
  });

  if (!send_form_input && !send_form_btn && !footer_popup) return;

  send_form_input?.addEventListener("input", () => {
    if (!validateEmail(send_form_input.value)) {
      send_email_error?.classList.add("active");
    } else {
      send_email_error?.classList.remove("active");
    }
  });

  send_form_btn?.addEventListener("click", () => {
    if (send_form_input?.value && validateEmail(send_form_input.value)) {
      form_email?.setAttribute("value", send_form_input.value);
      showPopup();
    }
  });

  popup_close?.addEventListener("click", () => {
    closePopup();
  });

  function showPopup(){
    footer_popup?.classList.add("active");
    setTimeout(() => {
      footer_popup?.classList.add("show");
    }, 100);
  }

  function closePopup(){
    form_email?.setAttribute("value", "");
    footer_popup?.classList.remove("active");
    setTimeout(() => {
      footer_popup?.classList.remove("show");
    }, 100);
  }

  function validateEmail(email) {
    const re =
      /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }

  const wpcf7Elm = document.querySelector(".wpcf7");

  wpcf7Elm?.addEventListener(
    "wpcf7mailsent",
    function (event) {
      setTimeout(() => {
        form_email?.setAttribute("value", "");
        footer_popup?.classList.remove("active");
        send_form_input.value = "";
      }, 1000);
    },
    false
  );
}
