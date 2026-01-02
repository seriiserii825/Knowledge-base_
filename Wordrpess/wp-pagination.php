<?php
if (isset($_GET['pg'])) {
  $current_page = $_GET['pg'];
} else {
  $current_page = 1;
}
$per_page = 3;
$offset = ($current_page - 1) * $per_page;

$news_page_id = 903;
$section_id = 'js-news-loop';

$news = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => $per_page,
  'offset' => $offset,
));
$posts = $news->posts;
$total_posts = $news->found_posts;
$total_pages = ceil($total_posts / $per_page);
?>
<section class="news-loop" id="<?php echo $section_id; ?>">
  <div class="container-big">
    <div class="news-loop__wrap">
      <?php foreach ($posts as $post): ?>
        <?php
        $id = $post->ID;
        $image = get_post_thumbnail_id($id);
        $title = get_the_title($id);
        $date = get_the_date('j F, Y', $id);
        $excerpt = get_the_excerpt($id);
        ?>
        <article class="news-loop__item">
          <div class="news-loop__img">
            <?php create_picture(my_get_image_id($image)) ?>
          </div>
          <div class="news-loop__date"><?php echo $date; ?></div>
          <h2 class="news-loop__title"><?php echo $title; ?></h2>
          <div class="news-loop__excerpt"><?php echo $excerpt; ?></div>
          <?php btnComponent(get_the_permalink($id), 'Leggi tutto') ?>
        </article>
      <?php endforeach; ?>
    </div>

    <?php if ($total_pages > 1) : ?>
      <?php
      $current_page = max(1, min((int)$current_page, (int)$total_pages));
      $window = 3; // how many pages to show around the current one
      $prev_page = max(1, $current_page - 1);
      $next_page = min($total_pages, $current_page + 1);
      // Determine window range
      $start = max(2, $current_page - 1);
      $end   = min($total_pages - 1, $current_page + 1);
      // Adjust if near the edges
      if ($current_page <= 3) {
        $start = 2;
        $end = min($total_pages - 1, $window + 1);
      } elseif ($current_page >= $total_pages - 2) {
        $start = max(2, $total_pages - $window);
        $end = $total_pages - 1;
      }
      ?>
      <ul class="paginate">
        <!-- Prev -->
        <li class="paginate__arrow<?= $current_page == 1 ? ' disabled' : '' ?>">
          <a href="<?php echo get_the_permalink($news_page_id); ?>?pg=<?php echo $prev_page; ?>#<?php echo $section_id; ?>">
            <?php get_template_part('template-parts/icons/icon-paginate'); ?>
          </a>
        </li>
        <!-- Always show first page -->
        <li>
          <a href="<?php echo get_the_permalink($news_page_id); ?>?pg=1#<?php echo $section_id; ?>" class="<?php echo $current_page == 1 ? 'active' : ''; ?>">01</a>
        </li>
        <!-- Left dots -->
        <?php if ($start > 2) : ?>
          <li class="paginate__dots">…</li>
        <?php endif; ?>
        <!-- Middle window -->
        <?php for ($i = $start; $i <= $end; $i++) : ?>
          <li>
            <a href="<?php echo get_the_permalink($news_page_id); ?>?pg=<?php echo $i; ?>#<?php echo $section_id; ?>" class="<?php echo $current_page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <!-- Right dots -->
        <?php if ($end < $total_pages - 1) : ?>
          <li class="paginate__dots">…</li>
        <?php endif; ?>
        <!-- Always show last page -->
        <?php if ($total_pages > 1) : ?>
          <?php
          $i_str = $total_pages < 10 ? '0' . $total_pages : $total_pages;
          ?>
          <li>
            <a href="<?php echo get_the_permalink($news_page_id); ?>?pg=<?php echo $total_pages; ?>#<?php echo $section_id; ?>" class="<?php echo $current_page == $total_pages ? 'active' : ''; ?>"><?php echo $i_str; ?></a>
          </li>
        <?php endif; ?>
        <!-- Next -->
        <li class="paginate__arrow paginate__arrow--right<?= $current_page == $total_pages ? ' disabled' : '' ?>">
          <a href="<?php echo get_the_permalink($news_page_id); ?>?pg=<?php echo $next_page; ?>#<?php echo $section_id; ?>">
            <?php get_template_part('template-parts/icons/icon-paginate'); ?>
          </a>
        </li>
      </ul>
    <?php endif; ?>
  </div>
</section>
