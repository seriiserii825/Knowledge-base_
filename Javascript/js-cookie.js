import { bodyHidden, bodyVisible } from './bodyHidden';

export default function bonus_popup() {
	const popup = document.querySelector('.bonus-popup');
	const bonus_popup = getCookie('bonus_popup');
	const close_popup_btn = document.querySelector('.bonus-popup__close');
    const bonus_btn = document.querySelector('.bonus-popup .btn');
	if (!bonus_popup) {
		showPopup();
	}
	close_popup_btn.addEventListener('click', function () {
		closePopup();
	});

	bonus_btn.addEventListener('click', function () {
        setCookie('bonus_popup');
        closePopup();
	});

	function getCookie(name) {
		var matches = document.cookie.match(
			new RegExp(
				'(?:^|; )' +
					name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') +
					'=([^;]*)'
			)
		);
		return matches ? decodeURIComponent(matches[1]) : undefined;
	}
	function setCookie(name) {
		let cookie_date = new Date();
		cookie_date.setYear(cookie_date.getFullYear() + 1);
		document.cookie = name + '=rewind;expires=' + cookie_date.toUTCString();
	}
	function showPopup() {
		bodyHidden();
		popup.classList.add('active');
	}
	function closePopup() {
		bodyVisible();
		popup.classList.remove('active');
	}
}
