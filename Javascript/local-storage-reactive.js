window.dispatchEvent(new CustomEvent("ar-localstorage-update"));

window.addEventListener("ar-localstorage-update", () => {
  is_authenticated.value = getUsername() ? true : false;
});
