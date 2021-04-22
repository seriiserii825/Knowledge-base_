	$(document).keyup(function (e) {
		if (e.key === "Escape") { // escape key maps to keycode `27`
			$('.search_box').removeAttr('checked');
		}
	});

	document.addEventListener('mousedown', function (e) {
		let  searchBox = document.querySelector('.search_box');
		if ( searchBox) {
			console.log(e.target.closest('.search'));
			if (e.target.closest('.search') === null) {
				 searchBox.checked = false;;
			}
		}
	});
