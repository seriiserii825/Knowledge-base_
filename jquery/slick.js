custom_slider.on(
  'beforeChange',
  function (event, slick, currentSlide, nextSlide) {
    images.removeClass('active');
    images[nextSlide].classList.add('active');
  }
);
