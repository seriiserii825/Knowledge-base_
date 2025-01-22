<?php
// campegio chissonetto
$custom_slider = get_field('custom_slider');
$items = $custom_slider['items'];
?>
<div class="custom-slider">
    <div class="custom-slider__wrap">
        <div class="custom-slider--first custom-slider__item  custom-slider--no-image">
            <h2 class="custom-slider__label"><?php echo $items[0]['label']; ?></h2>
            <div class="custom-slider__footer">
                <h3 class="custom-slider__title"><?php echo $items[0]['title']; ?></h3>
                <div>
                    <div class="custom-slider__btn custom-slider__btn--next">
                        <?php get_template_part('template-parts/icons/icon-btn-next'); ?>
                    </div>
                    <div class="custom-slider__btn custom-slider__btn--prev">
                        <?php get_template_part('template-parts/icons/icon-btn-next'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($items as $k => $item): ?>
                    <?php
                    $label = $item['label'];
                    $title = $item['title'];
                    $image = $item['image'];
                    ?>
                    <div class="swiper-slide custom-slider__item <?php echo $k === 0 ? ' custom-slider--no-image' : null ?>">
                        <?php if ($k === 0): ?>
                            <h2 class="custom-slider__label"><?php echo $label; ?></h2>
                            <div class="custom-slider__footer">
                                <h3 class="custom-slider__title"><?php echo $title; ?></h3>
                            </div>
                        <?php else: ?>
                            <h3 class="custom-slider__title"><?php echo $title; ?></h3>
                            <img src="<?php echo $image; ?>" alt="">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="custom-slider__btns">
            <div class="custom-slider__btn custom-slider__btn--next">
                <?php get_template_part('template-parts/icons/icon-btn-next'); ?>
            </div>
            <div class="custom-slider__btn custom-slider__btn--prev">
                <?php get_template_part('template-parts/icons/icon-btn-next'); ?>
            </div>
        </div>
    </div>
</div>

<style lang="scss">
.custom-slider {
  position: relative;
  padding: 96px 0;
  &--first.custom-slider__item.custom-slider--no-image {
    position: absolute;
    top: 0;
    left: 160px;
    display: flex !important;
    padding: 32px;
    width: 533px;
    height: 720px;
    background: var(--accent);
    z-index: 2;
    @media screen and (max-width: 1200px) {
      display: none !important;
    }
  }
  &--no-image.custom-slider__item {
    display: none !important;
    padding: 32px;
    width: 533px;
    height: 720px;
    background: var(--accent);
    @media screen and (max-width: 1200px) {
      display: flex !important;
    }
    @media screen and (max-width: 576px) {
      width: auto;
      height: auto;
    }
  }
  &__wrap {
    position: relative;
  }
  &__item {
    position: relative;
    display: flex !important;
    flex-direction: column;
    justify-content: flex-end;
    aspect-ratio: 533/720;
    padding: 3.2rem;
    @media screen and (min-width: 576px) {
      width: 533px !important;
    }
    img {
      position: absolute;
      top: 0;
      left: 0;
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }
  }
  &__label {
    margin-bottom: auto;
    font-size: 6.4rem;
    font-weight: 600;
    line-height: 110%;
    color: var(--contrast-dark);
    @media screen and (max-width: 576px) {
      font-size: 3.2rem;
    }
  }
  &__title {
    max-width: 23rem;
    font-size: 2.4rem;
    font-weight: 500;
    line-height: 130%;
    color: #fff;
  }
  &__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  &__btns {
    display: none;
    @media screen and (max-width: 1200px) {
      position: absolute;
      bottom: 30px;
      right: 5vw;
      display: block;
      z-index: 100;
    }
  }
  &__btn {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 4.8rem;
    height: 4.8rem;
    border-radius: 50%;
    background: transparent;
    border: 1px solid #fff;
    cursor: pointer;
    transition: all 0.4s;
    &:hover {
      background: black;
    }
    &:first-of-type {
      margin-bottom: 1.6rem;
    }
    &:last-of-type {
      transform: rotate(180deg);
    }
  }
}
</style>

<script>
// import Swiper JS
import Swiper from "swiper";
// import Swiper styles
import "swiper/css";
export default function customSlider() {
  let slides_offset = 693;
  if (window.innerWidth <= 1200) {
    slides_offset = 0;
  }
  const swiper = new Swiper(".swiper", {
    slidesPerView: "auto",
    slidesOffsetBefore: slides_offset,
    breakpoints: {
      300: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: "auto",
      },
    },
  });
  const btns_prev = document.querySelectorAll(".custom-slider__btn--prev");
  const btns_next = document.querySelectorAll(".custom-slider__btn--next");
  if (!btns_next || !btns_prev) return;
  // swiper.slideNext();

  btns_prev.forEach((btn) => {
    btn.addEventListener("click", () => {
      swiper.slidePrev();
    });
  });

  btns_next.forEach((btn) => {
    btn.addEventListener("click", () => {
      swiper.slideNext();
    });
  });
}
</script>
