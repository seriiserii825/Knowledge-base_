	let addMeta = function () {
		let pageTitle = location.pathname;

		pageTitle = pageTitle.replace(/\//gi, '');

		if ($('body').hasClass('post-type-archive-'+pageTitle+'')) {
			let metaDescription = $('meta[name="description"]').attr('content');
			let metaFacebook = '<meta property="og:description" content="' + metaDescription + '"/>';
			let metaTwitter = '<meta property="twitter:description" content="' + metaDescription + '"/>';

			$('head').append(metaFacebook);
			$('head').append(metaTwitter);
		}
	};

	addMeta();
