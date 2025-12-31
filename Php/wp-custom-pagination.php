<?php
$gallery_page_id = 7;
$section_id = "js-complex-gallery";
$complex_gallery = get_field('complex_gallery');
$images = $complex_gallery['images'];
$clone = $complex_gallery['clone'];
if ($clone) {
  $images = array_merge($images, $images, $images, $images, $images, $images, $images, $images);
}

if (isset($_GET['pg'])) {
  $current_page = $_GET['pg'];
} else {
  $current_page = 1;
}
$per_page = 12;
$offset = ($current_page - 1) * $per_page;

$total_gallery_images = count($images);
$total_pages = ceil($total_gallery_images / $per_page);

$images = array_slice($images, $offset, $per_page);
?>
<section class="complex-gallery" id="<?php echo $section_id; ?>">
  <div class="container-big">
    <div class="complex-gallery__wrap">
      <?php foreach ($images as $image) : ?>
        <a href="<?php echo $image['url']; ?>" class="complex-gallery__item">
          <?php create_picture(my_get_image_id($image)) ?>
        </a>
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
          <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=<?php echo $prev_page; ?>#<?php echo $section_id; ?>">
            <?php get_template_part('template-parts/icons/icon-paginate'); ?>
          </a>
        </li>

        <!-- Always show first page -->
        <li>
          <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=1#<?php echo $section_id; ?>" class="<?php echo $current_page == 1 ? 'active' : ''; ?>">1</a>
        </li>

        <!-- Left dots -->
        <?php if ($start > 2) : ?>
          <li class="paginate__dots">…</li>
        <?php endif; ?>

        <!-- Middle window -->
        <?php for ($i = $start; $i <= $end; $i++) : ?>
          <li>
            <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=<?php echo $i; ?>#<?php echo $section_id; ?>" class="<?php echo $current_page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>

        <!-- Right dots -->
        <?php if ($end < $total_pages - 1) : ?>
          <li class="paginate__dots">…</li>
        <?php endif; ?>

        <!-- Always show last page -->
        <?php if ($total_pages > 1) : ?>
          <li>
            <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=<?php echo $total_pages; ?>#<?php echo $section_id; ?>" class="<?php echo $current_page == $total_pages ? 'active' : ''; ?>"><?php echo $total_pages; ?></a>
          </li>
        <?php endif; ?>

        <!-- Next -->
        <li class="paginate__arrow paginate__arrow--right<?= $current_page == $total_pages ? ' disabled' : '' ?>">
          <a href="<?php echo get_the_permalink($gallery_page_id); ?>?pg=<?php echo $next_page; ?>#<?php echo $section_id; ?>">
            <?php get_template_part('template-parts/icons/icon-paginate'); ?>
          </a>
        </li>
      </ul>
    <?php endif; ?>
  </div>
</section>
