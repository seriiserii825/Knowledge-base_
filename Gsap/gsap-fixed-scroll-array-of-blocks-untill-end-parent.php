<!-- meridiana -->
<section class="our-products">
  <h2 class="our-products__title title title--small"><?php echo $title; ?></h2>
  <div class="our-products__text text text--light"><?php echo $text; ?></div>
  <div class="our-products__container">
    <?php foreach ($blocks as $block) : ?>
      <?php
      $title = $block['title'];
      $text = $block['text'];
      $items = $block['items'];
      $background = $block['background'];
      $less_products = count($items) < 3  ? 'our-products__item--less-products' : '';
      $two_products = count($items) == 2  ? 'our-products__item--two-products' : '';
      $url = $block['url'];
      ?>
      <div class="our-products__body">
        <div class="our-products__item <?php echo $less_products; ?> <?php echo $two_products; ?>" style="background: <?php echo $background; ?>;">
          <div class="our-products__inner">
            <div class=" our-products__header">
              <div class="our-products__left">
                <h3 class="our-products__name title title--small"><?php echo $title; ?></h3>
                <div class="our-products__description text"><?php echo $text; ?></div>
              </div>
              <a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" class="btn"><?php echo $button_text; ?></a>
            </div>
            <div class="our-products__slider">
              <div class="slider-btn slider-btn--prev our-products__btn--prev">
                <?php get_template_part('template-parts/icons/icon-slider-arrow-right'); ?>
              </div>
              <div class="slider-btn slider-btn--next our-products__btn--next">
                <?php get_template_part('template-parts/icons/icon-slider-arrow-right'); ?>
              </div>
              <div class="our-products__wrap">
                <?php foreach ($items as $item) : ?>
                  <?php
                  $image = $item['image'];
                  $subtitle = $item['subtitle'];
                  $url = $item['url'];
                  ?>
                  <a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" class="our-products__slide">
                    <div class="our-products__img">
                      <?php create_picture(my_get_image_id($image)) ?>
                    </div>
                    <h4 class="our-products__subtitle"><?php echo $subtitle; ?></h4>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<script>
  import gsap from 'gsap';
  import ScrollTrigger from 'gsap/ScrollTrigger';

  export default function ourProductsAnimation() {
    const section = document.querySelector(
      '.our-products__container'
    ) as HTMLElement;
    const boxes = document.querySelectorAll(
      '.our-products__body'
    ) as NodeListOf < HTMLElement > ;

    if (!boxes.length) return;

    gsap.registerPlugin(ScrollTrigger);

    // 1. Создаём триггеры
    boxes.forEach((box) => makeTrigger(box, section));

    // 2. После полной загрузки страницы и всех картинок – пересчитываем
    window.addEventListener('load', () => ScrollTrigger.refresh());

    // 3. Один debounced resize listener вместо одного на каждый блок
    let resizeTimer: ReturnType < typeof setTimeout > ;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => ScrollTrigger.refresh(), 200);
    });
  }

  function makeTrigger(box: HTMLElement, section: HTMLElement) {
    const item = box.querySelector('.our-products__item') as HTMLElement;

    ScrollTrigger.create({
      trigger: box,
      start: 'top 100',
      endTrigger: section,
      end: () => `bottom bottom`,
      // markers: true,
      pin: item,
      pinSpacing: false,
      anticipatePin: 1
    });
  }
</script>
