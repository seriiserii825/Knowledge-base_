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

// No need to add "slidesToShow: 3.5 option"

// Just call slick:-

// $('.Your-container').slick({
//     arrows: false,
// });
// and add following CSS:

// .slick-list{padding:0 20% 0 0 !important;}
// Either you can give a fixed padding to the right or percentage.

//equal height

slider.slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
            }
        }
    ]
}).on('setPosition', function (event, slick) {
    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
});

