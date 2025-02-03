export default function servicesScroll() {
	const services_icons = document.querySelectorAll('.services__icon');

	if (services_icons.length)  {
		services_icons.forEach((icon) => {
			icon.addEventListener('click', (e) => {
				e.preventDefault();
				const href  = icon.getAttribute('href');
				const hash = href?.split('#')[1];
				const url = href?.split('#')[0];
				if (!hash || !url) return;
				localStorage.setItem('services_scroll', href);
				window.location.href = url;
			});
		});
	}

	const url = localStorage.getItem('services_scroll');
	const url_hash = url?.split('#')[1];
	if (!url_hash) return;
	if (url_hash.includes('our-services')){
		const block = 	document.querySelector('#'+url_hash);
		if (block) {
			const block_top = block.getBoundingClientRect().top;
			const scroll_top = window.pageYOffset;
			const header = document.querySelector('.main-header');
			const header_height = header ? header.clientHeight : 0;
			const scroll_to = block_top + scroll_top - header_height;
			window.scrollTo({
				top: scroll_to,
				behavior: 'smooth'
			});
			localStorage.removeItem('services_scroll');
		}
	}
}
