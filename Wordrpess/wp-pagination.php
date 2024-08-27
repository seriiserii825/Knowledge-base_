<!-- !!!! ATTENZIONE !!!! -->
<!-- Don't use the same slug for page and post-type, pagination will not work. -->

  <?php
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $articoli = new WP_Query([
    'post_type' => 'articoli',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged'          => $paged,
  ]); ?>
  <div class="l-container">
    <div class="page-articoli__wrap">
      <?php if ($articoli->have_posts()) : ?>
        <?php while ($articoli->have_posts()) : ?>
          <?php $articoli->the_post(); ?>
          <a href="<?php the_permalink(); ?>" class="page-articoli__item item-articoli">
            <div class="item-articoli__img">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="item-articoli__content">
              <h2 class="item-articoli__title"><?php the_title(); ?></h2>
            </div>
          </a>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>

    </div>
    <?php wp_pagenavi(array('query' => $articoli)); ?>
  </div>
