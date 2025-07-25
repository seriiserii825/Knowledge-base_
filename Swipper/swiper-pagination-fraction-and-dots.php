<?php
$custom_slider = get_field('custom_slider');
$title = $custom_slider['title'];
$text = $custom_slider['text'];
$gallery = $custom_slider['gallery'];
$button_text = $custom_slider['button_text'];
?>
<div class="custom-gallery">
  <?php get_template_part('template-parts/icons/icon-custom-gallery'); ?>
  <h2 class="custom-gallery__title title"><?php echo $title; ?></h2>
  <div class="custom-gallery__text text"><?php echo $text; ?></div>
  <div class="swiper custom-gallery__slider">
    <div class="swiper-wrapper">
      <?php foreach ($gallery as $gallery_item) : ?>
        <div class="swiper-slide">
          <img src="<?php echo $gallery_item; ?>" alt="<?php echo $gallery_item; ?>" />
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Dots Pagination -->
    <div class="custom-gallery__pagination swiper-pagination-bullets"></div>

    <!-- Fraction Pagination -->
    <div class="custom-gallery__fraction swiper-pagination-fraction"></div>
  </div>
</div>


<script>
import Swiper from "swiper";
import { Pagination } from "swiper/modules";
import "swiper/css";

Swiper.use([Pagination]);

export default function customSliderSwiper() {
  const desktop_per_view = 2;
  const swiper = new Swiper(".custom-gallery__slider", {
    speed: 400,
    slidesPerView: 1,
    slidesPerGroup: 1,
    spaceBetween: 0,
    loop: false,
    pagination: {
      el: ".custom-gallery__pagination",
      clickable: true,
      type: "bullets",
      bulletClass: "swiper-pagination-bullet",
      bulletActiveClass: "swiper-pagination-bullet-active",
    },
    breakpoints: {
      768: {
        slidesPerView: desktop_per_view,
        slidesPerGroup: 2,
        spaceBetween: 50,
      },
    },
    on: {
      afterInit(this: Swiper) {
        updateFraction(this);
      },
      slideChange(this: Swiper) {
        updateFraction(this);
      },
      resize(this: Swiper) {
        updateFraction(this);
      },
    },
  });

  // Update fraction after initialization
  updateFraction(swiper);
}

function updateFraction(swiper: Swiper) {
  // Handle slidesPerView which can be number, "auto", or undefined
  const slidesPerView = typeof swiper.params.slidesPerView === 'number' 
    ? swiper.params.slidesPerView 
    : 1; // Default to 1 if "auto" or undefined
  const slidesPerGroup = swiper.params.slidesPerGroup || 1;
  const totalSlides = swiper.slides.length;

  // Calculate total groups based on slidesPerGroup
  const totalGroups = Math.ceil(totalSlides / slidesPerGroup);

  // Calculate current group based on active slide index
  const currentIndex = swiper.activeIndex;
  const currentGroup = Math.ceil((currentIndex + slidesPerView) / slidesPerGroup);

  const fractionEl = document.querySelector(".custom-gallery__fraction");
  if (fractionEl) {
    fractionEl.innerHTML = `${currentGroup} / ${totalGroups}`;
  }
}
</script>
