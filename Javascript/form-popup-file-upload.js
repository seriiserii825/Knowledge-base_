import {bodyHidden, bodyVisible} from "../header/bodyHidden";

export default function candidatePopup() {
    const popup = document.querySelector('#js-candidate-popup');
    const popup_open = document.querySelector('#js-show-candidate-popup');
    const popup_close = document.querySelector('#js-candidate-popup-close');
    const submit_btn = document.querySelector('#js-candidate-popup input[type="submit"]');
    const file_input = document.querySelector('#js-candidate-popup input[type="file"]');
    const file_result_span = document.querySelector('#js-candidate-popup .form__result-span');
    const file_result_svg = document.querySelector('#js-candidate-popup .form__result svg');
    const file_result_span_text = file_result_span.textContent;

    file_input.addEventListener('change', () => {
        const name = file_input.files[0].name;
        if (name) {
            file_result_span.textContent = name;
            file_result_svg.style.display = 'none';
        } else {
            file_result_span.textContent = file_result_span_text;
            file_result_svg.style.display = 'block';
        }
    });

    popup_open.addEventListener('click', (e) => {
        e.preventDefault();
        showPopup();
    });
    popup_close.addEventListener('click', closePopup);

    submit_btn.addEventListener('click', () => {
        const messsage = document.querySelector('#js-candidate-popup .wpcf7-form');
        setTimeout(() => {
            const is_failed = messsage.classList.contains('invalid');
            if (!is_failed) {
                closePopup();
            }
        }, 3000);
    });

    function showPopup() {
        bodyHidden();
        popup.classList.add('active');
    }

    function closePopup() {
        bodyVisible();
        popup.classList.remove('active');
    }
}
