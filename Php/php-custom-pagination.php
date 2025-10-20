<?php
$home_page_id = 7;
$our_studio = get_field('our_studio', $home_page_id);
$title = $our_studio['title'];
$button_text = $our_studio['button_text'];
$items = $our_studio['items'];
$items = array_merge($items, $items, $items, $items, $items, $items, $items, $items, $items, $items, $items, $items);
$text = $our_studio['text'];
$gallery_page_id = 669;
$is_home_page = is_front_page();
$class = $is_home_page ? 'our-studio--home' : 'our-studio--gallery';
if (isset($_GET['pg'])) {
  $current_page = $_GET['pg'];
} else {
  $current_page = 1;
}
$per_page = $is_home_page ? 6 : 9;
$offset = ($current_page - 1) * $per_page;

$total_gallery_items = count($items);
$total_pages = ceil($total_gallery_items / $per_page);

$items = array_slice($items, $offset, $per_page);
?>
<section class="our-studio <?php echo $class; ?>">
  <div class="container">
    <h3 class="our-studio__title title title--accent"><?php echo $title; ?></h3>
    <?php if (!$is_home_page) : ?>
      <div class="our-studio__text"><?php echo $text; ?></div>
    <?php endif; ?>
    <div class="our-studio__wrap" id="js-our-studio-wrap">
      <?php foreach ($items as $item) : ?>
        <?php
        $small_image = my_get_image_id($item['small_image']);
        $big_image = $item['big_image']['url'];
        $width = $item['width'];
        ?>
        <?php if ($is_home_page) : ?>
          <div class="our-studio__item w-<?php echo $width; ?>">
            <?php create_picture($small_image) ?>
          </div>
        <?php else : ?>
          <a href=" <?php echo $big_image; ?>" class="our-studio__item w-<?php echo $width; ?>">
            <?php create_picture($small_image) ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <?php if ($is_home_page) : ?>
      <footer class="our-studio__footer">
        <a href="<?php echo get_the_permalink($gallery_page_id); ?>" class="btn btn--dark"><?php echo $button_text; ?></a>
      </footer>
    <?php endif; ?>
    <?php if (!$is_home_page) : ?>
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
            <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=<?php echo $prev_page; ?>#js-our-studio-wrap">
              <?php get_template_part('template-parts/icons/icon-paginate'); ?>
            </a>
          </li>

          <!-- Always show first page -->
          <li>
            <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=1#js-our-studio-wrap" class="<?php echo $current_page == 1 ? 'active' : ''; ?>">1</a>
          </li>

          <!-- Left dots -->
          <?php if ($start > 2) : ?>
            <li class="paginate__dots">…</li>
          <?php endif; ?>

          <!-- Middle window -->
          <?php for ($i = $start; $i <= $end; $i++) : ?>
            <li>
              <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=<?php echo $i; ?>#js-our-studio-wrap" class="<?php echo $current_page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>

          <!-- Right dots -->
          <?php if ($end < $total_pages - 1) : ?>
            <li class="paginate__dots">…</li>
          <?php endif; ?>

          <!-- Always show last page -->
          <?php if ($total_pages > 1) : ?>
            <li>
              <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=<?php echo $total_pages; ?>#js-our-studio-wrap" class="<?php echo $current_page == $total_pages ? 'active' : ''; ?>"><?php echo $total_pages; ?></a>
            </li>
          <?php endif; ?>

          <!-- Next -->
          <li class="paginate__arrow paginate__arrow--right<?= $current_page == $total_pages ? ' disabled' : '' ?>">
            <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=<?php echo $next_page; ?>#js-our-studio-wrap">
              <?php get_template_part('template-parts/icons/icon-paginate'); ?>
            </a>
          </li>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</section>
