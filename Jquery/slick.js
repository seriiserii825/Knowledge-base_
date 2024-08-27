// in flex container
// For me adding overflow: hidden; to the slider element (which gets the slick-initialized slick-slider classes) fixed the problem.
//

// swipe: false,

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

// show 3 slides and crop for right and left

$(document).ready(function () {
  $('.carousel').slick({
    slidesToShow: 3, // Number of slides to show at once
    centerMode: true, // Enable center mode
    centerPadding: '20%', // Adjust the padding for the left and right sides
    focusOnSelect: true, // Set the clicked slide as the center slide
    variableWidth: true, // Variable width to allow for cropping
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1, // Show 1 slide on smaller screens
          centerPadding: '0', // Remove cropping on smaller screens
        }
      }
    ]
  });
});


// custom navigation
function inspirationSlider() {
  const slider = $('.inspiration__wrap');
  const prev_btn = $('.inspiration__btn--prev');
  const next_btn = $('.inspiration__btn--next');
  const dots_li = $('.inspiration__dots li');
  slider.slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    dots: false,
  });
  prev_btn.on('click', function () {
    slider.slick('slickPrev');
    const current = slider.slick('slickCurrentSlide');
    dots_li.removeClass('active');
    dots_li.eq(current).addClass('active');
  });
  next_btn.on('click', function () {
    slider.slick('slickNext');
    const current = slider.slick('slickCurrentSlide');
    dots_li.removeClass('active');
    dots_li.eq(current).addClass('active');
  });
  dots_li.on('click', function () {
    const index = $(this).index();
    slider.slick('slickGoTo', index);
    dots_li.removeClass('active');
    $(this).addClass('active');
  });
  slider.on('afterChange', function (event, slick, currentSlide) {
    dots_li.removeClass('active');
    dots_li.eq(currentSlide).addClass('active');
  });
}
