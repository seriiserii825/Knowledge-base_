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
  import {
    Pagination
  } from "swiper/modules";
  import "swiper/css";

  Swiper.use([Pagination]);

  export default function customSwiper() {
    const swiper = new Swiper(".custom-gallery__slider", {
      speed: 400,
      slidesPerView: 2,
      spaceBetween: 50,
      pagination: {
        el: ".custom-gallery__pagination",
        clickable: true,
        type: "bullets",
        bulletClass: "swiper-pagination-bullet",
        bulletActiveClass: "swiper-pagination-bullet-active",
      },
    });

    // ✅ Safe: use swiper *after* it's defined
    updateFraction(swiper);

    swiper.on("slideChange", () => {
      updateFraction(swiper);
    });
  }

  function updateFraction(swiper: Swiper) {
    const current = swiper.realIndex + 1;
    const total = swiper.slides.length;
    const fractionEl = document.querySelector(".custom-gallery__fraction");
    if (fractionEl) {
      fractionEl.innerHTML = `${current} / ${total}`;
    }
  }
</script>
