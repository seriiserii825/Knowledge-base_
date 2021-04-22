	let activeMenuItem = function () {
		let sitePath = location.pathname;
		if (sitePath !== '/' && sitePath !== '/de/' && sitePath !== '/en/') {
			$('.main-menu > li > a').each(function () {
				let href = $(this).attr('href');
				if (href.includes(sitePath)) {
					$(this).closest('li').addClass('current-menu-item');
				}
			});

			$('.sub-menu  li  a').each(function () {
				let href = $(this).attr('href');
				if (href.includes(sitePath)) {
					$(this).closest('.sub-menu').closest('li').addClass('current-menu-item');
				}
			});
		}
	};
	activeMenuItem();
