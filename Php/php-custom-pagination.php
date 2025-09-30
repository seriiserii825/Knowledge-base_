<?php
if (isset($_GET['pg'])) {
  $current_page = $_GET['pg'];
} else {
  $current_page = 1;
}
$per_page = 7;
$offset = ($current_page - 1) * $per_page;
$query_args = array(
  'post_type' => 'post',
  'posts_per_page' => $per_page,
  'offset' => $offset,
);

$category_slug = isset($_GET['category']) ? $_GET['category'] : null;
if ($category_slug) {
  $query_args['category_name'] = $category_slug;
}

$posts = new WP_Query($query_args);
$posts_array = $posts->posts;

$total_posts = $posts->found_posts;
$total_pages = ceil($total_posts / $per_page);
?>
<div class="posts-loop">
  <div class="container">
    <?php
    $post_big_id = $posts_array[0]->ID;
    $image = get_the_post_thumbnail_url($post_big_id, 'full');
    $title = get_the_title($post_big_id);
    $date = get_the_date('d/m/Y', $post_big_id);
    $category = get_the_category($post_big_id)[0]->name;
    $single_article = get_field('single_article', $post_big_id);
    $short_text = get_field('single_article_short_text', $post_big_id);
    $excerpt = get_the_excerpt($post_big_id);
    $permalink = get_permalink($post_big_id);
    ?>
    <div class="posts-loop__big">
      <div class="post-big">
        <div class="post-big__img">
          <img src="<?php echo $image; ?>" alt="">
        </div>
        <div class="post-big__content">
          <header class="posts-loop__header">
            <h3 class="posts-loop__category"><?php echo $category; ?></h3>
            <div class="posts-loop__date"><?php echo $date; ?></div>
          </header>
          <h2 class="posts-loop__title"><?php echo $title; ?></h2>
          <?php if ($short_text) : ?>

            <div class="post-big__short-text">
              <?php echo $short_text; ?>
            </div>
          <?php endif; ?>
          <a href="<?php echo $permalink; ?>" class="posts-loop__link">Leggi</a>
        </div>
      </div>
    </div>
    <div class="posts-loop__wrap">
      <?php foreach ($posts_array as $k => $post) : ?>
        <?php if ($k !== 0) : ?>
          <?php
          $post_id = $post->ID;
          $image = get_the_post_thumbnail_url($post_id, 'full');
          $title = get_the_title($post_id);
          $date = get_the_date('d/m/Y', $post_id);
          $category = get_the_category($post_id)[0]->name;
          $single_article = get_field('single_article', $post_id);
          $excerpt = get_the_excerpt($post_id);
          $permalink = get_permalink($post_id);
          ?>
          <div class="posts-loop__item">
            <div class="posts-loop__img">
              <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
            </div>
            <div class="posts-loop__content">
              <header class="posts-loop__header">
                <h3 class="posts-loop__category"><?php echo $category; ?></h3>
                <div class="posts-loop__date"><?php echo $date; ?></div>
              </header>
              <h2 class="posts-loop__title"><?php echo $title; ?></h2>
              <a href="<?php echo $permalink; ?>" class="posts-loop__link">Leggi</a>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <?php
    if ($total_pages > 1) :
      // window size around current (13,14,15)
      $range = 1;

      // clamp current page after we know total
      $current_page = max(1, min((int)$current_page, (int)$total_pages));

      // base URL + keep category in query if present
      $base_url = get_permalink(435);
      $persist = [];
      if (!empty($category_slug)) {
        $persist['category'] = $category_slug;
      }
      $url_for = function (int $pg) use ($base_url, $persist) {
        return esc_url(add_query_arg(array_merge($persist, ['pg' => $pg]), $base_url));
      };

      // pages to show: 1, current±range, last
      $pages = [1, $total_pages];
      for ($i = $current_page - $range; $i <= $current_page + $range; $i++) {
        if ($i >= 1 && $i <= $total_pages) $pages[] = $i;
      }
      $pages = array_values(array_unique($pages));
      sort($pages);
    ?>
      <ul class="paginate">
        <!-- Prev arrow -->
        <li class="paginate__arrow <?php echo ($current_page === 1) ? 'is-disabled' : ''; ?>">
          <a aria-label="Previous" href="<?php echo ($current_page > 1) ? $url_for($current_page - 1) : '#'; ?>">
            <?php get_template_part('template-parts/icons/icon-paginate'); ?>
          </a>
        </li>

        <?php
        $last = 0;
        foreach ($pages as $p) {
          if ($last && $p > $last + 1) {
            echo '<li class="dots">…</li>';
          }
          $active = ($p === $current_page) ? 'active' : '';
          echo '<li><a class="paginate__link ' . $active . '" href="' . $url_for($p) . '">' . $p . '</a></li>';
          $last = $p;
        }
        ?>

        <!-- Next arrow -->
        <li class="paginate__arrow paginate__arrow--right <?php echo ($current_page === $total_pages) ? 'is-disabled' : ''; ?>">
          <a aria-label="Next" href="<?php echo ($current_page < $total_pages) ? $url_for($current_page + 1) : '#'; ?>">
            <?php get_template_part('template-parts/icons/icon-paginate'); ?>
          </a>
        </li>
      </ul>
    <?php endif; ?>
  </div>
</div>
