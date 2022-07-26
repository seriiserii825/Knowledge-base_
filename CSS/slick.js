	function corsoFeaturesSlider() {
		let slickSliderActive = false;

		function checkSlider() {
			if ($(window).width() < 576 - getScroll()) {
				if (slickSliderActive == false) {
					$("#corso-features").slick({
						slidesToShow: 3,
						slidesToScroll: 3,
						dots: true,
						arrows: false,
					});
					slickSliderActive = true;
				}
			} else {
				if (slickSliderActive == true) {
					$("#corso-features").slick("unslick");
					slickSliderActive = false;
				}
			}
		}

		checkSlider();
		$(window).on("resize", checkSlider);

		function getScroll() {
			var div = document.createElement("div");
			div.style.overflowY = "scroll";
			div.style.width = "50px";
			div.style.height = "50px";
			div.style.visibility = "hidden";
			document.body.appendChild(div);
			var scrollWidth = div.offsetWidth - div.clientWidth;
			document.body.removeChild(div);
			return scrollWidth;
		}
	}
	if (document.querySelector(".corso-features")) {
		corsoFeaturesSlider();
	}

