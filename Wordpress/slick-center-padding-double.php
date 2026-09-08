  <div class="slider-big" id="js-slider-big">
    <div class="slider-big__wrap">
      <?php foreach ($items as $slider_big_item) : ?>
        <?php
        $title = $slider_big_item['title'];
        $image = $slider_big_item['image'];
        ?>
        <div class="slider-big__item">
          <div class="slider-big__img">
            <img src="<?php echo $image; ?>" alt="">
            <footer class="slider-big__footer">
              <h3 class="slider-big__title"><?php echo $title; ?></h3>
              <a href="" class="btn">
                <span><?php echo $button_text; ?></span>
              </a>
            </footer>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="slider-small" id="js-slider-small">
    <div class="container">
      <div class="slider-small__wrap">
        <?php foreach ($items as $slider_small_item) : ?>
          <?php
          $title = $slider_small_item['title'];
          $image = $slider_small_item['image'];
          ?>
          <div class="slider-small__item"><span><?php echo $title; ?></span></div>
        <?php endforeach; ?>
        <button class="slider-small__btn slider-small__btn--prev">
          <?php echo get_template_part('assets/svg/icon-slider-small-left'); ?>
        </button>
        <button class="slider-small__btn slider-small__btn--next">
          <?php echo get_template_part('assets/svg/icon-slider-small-left'); ?>
        </button>
      </div>
    </div>
  </div>

<script>
  if (slider_big) {
    categoriesOfImmobile();
  }
  function categoriesOfImmobile() {
    const slider_big_wrap = slider_big.find(".slider-big__wrap");
    const slider_small_item = $(".slider-small__item");
    const btn_prev = $(".slider-small__btn--prev");
    const btn_next = $(".slider-small__btn--next");
    slider_big_wrap.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      centerMode: true,
      centerPadding: "50rem",
      // responsive: [
      //     {
      //         breakpoint: 1400,
      //         settings: {
      //             slidesToShow: 3,
      //             slidesToScroll: 3
      //         }
      //     },
      //     {
      //         breakpoint: 1200,
      //         settings: {
      //             slidesToShow: 2,
      //             slidesToScroll: 2
      //         }
      //     },
      //     {
      //         breakpoint: 768,
      //         settings: {
      //             slidesToShow: 1,
      //             slidesToScroll: 1,
      //             adaptiveHeight: true
      //         }
      //     }
      //     // You can unslick at a given breakpoint now by adding:
      //     // settings: "unslick"
      //     // instead of a settings object
      // ]
    });
    slider_small_item.first().addClass("active");
    slider_small_item.on("click", function () {
      const slider_small_item_index = $(this).index();
      slider_big_wrap.slick("slickGoTo", slider_small_item_index);
      removeActiveClass();
      $(this).addClass("active");
    });
    function removeActiveClass() {
      slider_small_item.removeClass("active");
    }
    btn_prev.on("click", function () {
      slider_big_wrap.slick("slickPrev");
      removeActiveClass();
      slider_small_item
        .eq(slider_big_wrap.slick("slickCurrentSlide"))
        .addClass("active");
    });
    btn_next.on("click", function () {
      slider_big_wrap.slick("slickNext");
      removeActiveClass();
      slider_small_item
        .eq(slider_big_wrap.slick("slickCurrentSlide"))
        .addClass("active");
    });
  }
</script>

<style>
.slider-big {
  margin-bottom: 10.4rem;
  .slick-track {
    padding: 8rem 0;
  }
  &__item {
    position: relative;
    transition: all 0.4s;
    // transition-delay: 0.4s;
    &.slick-active {
      transform: scale(1.33);
    }
  }
  &__img {
    position: relative;
    display: table;
    margin: 0 auto;
    background: red;
    img {
      position: relative;
      z-index: 1;
    }
  }
  &__footer {
    position: absolute;
    bottom: 0;
    left: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 6.4rem;
    width: 100%;
    z-index: 2;
  }
  &__title {
    font-size: 3.2rem;
    font-style: italic;
    font-weight: 300; color: white; } &__btn {
  }
}

.slider-small {
  .container {
    position: relative;
  }
  &__wrap {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  &__item {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 1.6rem;
    padding: 1.6rem 3.2rem;
    vertical-align: baseline;
    font-size: 1.4rem;
    font-weight: normal;
    color: black;
    border-radius: 3.2rem;
    border: 1px solid rgba(13, 20, 51, 0.05);
    background: rgba(13, 20, 51, 0.05);
    cursor: pointer;
    transition: all 0.4s;
    &.active,
    &:hover {
      color: white;
      background: var(--accent-darkest);
    }
    span {
      position: relative;
      top: 0.2rem;
    }
  }
  &__btn {
    position: absolute;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 4.8rem;
    height: 4.8rem;
    border-radius: 50%;
    background: rgba(13, 20, 51, 0.05);
    border: none;
    transition: all 0.4s;
    &:hover {
      background: var(--accent-darkest);
      svg {
        stroke: white;
      }
    }
    &--prev {
      left: 1.5rem;
    }
    &--next {
      right: 1.5rem;
      transform: rotate(180deg);
    }
    svg {
      stroke: var(--accent-darkest);
      transition: all 0.4s;
    }
  }
}
</style>
