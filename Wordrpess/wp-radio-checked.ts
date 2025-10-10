export default function radioChecked() {
  const radioButtons = document.querySelectorAll(
    '.form-popup input[type="radio"]'
  ) as NodeListOf<HTMLInputElement>;

  radioButtons.forEach((radio) => {
    radio.addEventListener('change', () => {
      console.log(radio.checked, 'radio.checked');
      console.log(radio.value, 'radio.value');
      if (radio.checked) {
        const parent = radio.closest(".wpcf7-list-item") as HTMLElement;
        parent.classList.add('checked')
      }
    });
  });
}
