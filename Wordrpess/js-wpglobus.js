	let languageSelector = $('.wpglobus-selector-link ');
	$.each(languageSelector, function () {
		let code = $(this).find('.code').text();
		let languageText = '';

		function displayLanguageText(elem) {
			let img = elem.find('img');
			let imgSrc = img.attr('src');
			elem.empty();
			elem.append('<span class="name">' + languageText + '</span>');
			elem.append('<img src="' + imgSrc + '" alt="" />');
		}

		if (code === 'IT') {
			languageText = "Passa all'italiano";
			displayLanguageText($(this));
		} else if (code === 'EN') {
			languageText = "Switch to English";
			displayLanguageText($(this));
		} else if (code === 'DE') {
			languageText = "Wechseln Sie zu Deutsch";
			displayLanguageText($(this));
		}
	});
