custom_slider.on(
  "beforeChange",
  function (event, slick, currentSlide, nextSlide) {
    images.removeClass("active");
    images[nextSlide].classList.add("active");
  }
);

$(window).on("load resize orientationchange", function () {
  let blogSlider = $("#js-blog");
  if ($(window).width() > 992) {
    if (blogSlider.hasClass("slick-initialized")) {
      blogSlider.slick("unslick");
    }
  } else {
    if (!blogSlider.hasClass("slick-initialized")) {
      blogSlider.slick({
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: false,
        dots: true,
        responsive: [
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });
    }
  }
});
