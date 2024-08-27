<scrpt>
	popupAll.forEach((item) => {
		item.querySelector('form input[type="submit"]').addEventListener(
			'click',
			function () {
				setTimeout(() => {
					const error = document.querySelector(
						'.wpcf7-not-valid-tip'
					);
					if (!error) {
						setTimeout(() => {
							hideModal();
						}, 300);
					}
				}, 2000);
			}
		);
	});
</scrpt>
