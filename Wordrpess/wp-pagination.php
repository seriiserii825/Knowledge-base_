<?php
$works = get_field('works', 2);
if (isset($_GET['pg'])) {
  $current_page = $_GET['pg'];
} else {
  $current_page = 1;
}
$per_page = 2;
$offset = ($current_page - 1) * $per_page;
$works_posts = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => $per_page,
  'offset' => $offset,
]);
$total_posts = $works_posts->found_posts;
$total_pages = ceil($total_posts / $per_page);
?>
<section class="works <?php echo $class; ?>">
  <div class="works__body">
    <?php if ($works_posts->have_posts()): ?>
      <?php while ($works_posts->have_posts()): ?>
        <?php $works_posts->the_post(); ?>
        <?php
        $image = get_the_post_thumbnail_url();
        $subtitle = get_the_title();
        $text = get_the_excerpt();
        $single_article = get_field('single_article');
        $date = $single_article['date'];
        $permalink = get_the_permalink();
        ?>
        <div class="works__item">
          <div class="works__img">
            <img src="<?php echo $image; ?>" alt="<?php echo $image; ?>" loading="lazy" />
            <div class="works__info">
              <div class="works__date"><?php echo $date; ?></div>
              <h3 class="works__subtitle title"><?php echo $subtitle; ?></h3>
            </div>
          </div>
          <div class="works__content">
            <div class="works__text"><?php echo $text; ?></div>
            <a href="<?php echo $permalink; ?>" class="btn"><?php echo $button_text; ?></a>
          </div>
        </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
  <?php if ($total_pages > 1): ?>
    <ul class="paginate">
      <li class="disabled paginate__arrow">
        <?php get_template_part('template-parts/icons/icon-paginate'); ?>
      </li>
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="<?php echo $current_page == $i ? 'active' : null; ?>"><a href="<?php echo get_the_permalink(435); ?>?pg=<?php echo $i; ?>"><?php echo $i; ?></a></li>
      <?php endfor; ?>
      <li class="paginate__arrow paginate__arrow--right">
        <?php get_template_part('template-parts/icons/icon-paginate'); ?>
      </li>
    </ul>
  <?php endif; ?>
</section>
