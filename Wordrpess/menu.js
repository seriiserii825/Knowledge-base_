	let activeMenuItem = function () {
		let siteUrl = location.href
		$('#js-main-menu li a').each(function () {
			let href = $(this).attr('href');
			if (siteUrl === href) {
				$(this).closest('li').addClass('current-menu-item');
			}
		});
	};
	activeMenuItem();
