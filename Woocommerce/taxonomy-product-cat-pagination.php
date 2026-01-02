<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
get_header();
?>
<?php
$term_query = get_queried_object();
$current_term_id = $term_query->term_id;
$current_term = get_term($current_term_id, 'product_cat');
$current_term_slug = $current_term->slug;
$title = $current_term->name;
$title = 'Francesca <strong>by Sottini</strong>';
$subtitle = $current_term->name;
$category = get_field('category', $current_term);
$image = $category['image'];
?>
<div class="single-category page-top">
  <div class="single-category__wrap">
    <div class="single-category__img">
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy" />
    </div>
    <div class="single-category__content">
      <h2 class="single-category__title complex-title"><?php echo $title; ?></h2>
      <h1 class="single-category__subtitle"><?php echo $subtitle; ?></h1>
    </div>
  </div>
</div>
<div class="products-loop">
  <?php
  if (isset($_GET['page_num'])) {
    $page_number = $_GET['page_num'];
  } else {
    $page_number = 1;
  }
  $total_products = wc_get_products([
    'category' => $current_term_slug,
    'limit' => -1,
  ]);
  $total_products = count($total_products);
  $per_page = 8;
  $total_pages = ceil($total_products / $per_page);
  $current_page = $page_number;
  $products = wc_get_products([
    'orderby' => 'date',
    'order' => 'DESC',
    'limit' => $per_page,
    'page' => $current_page,
    'category' => $current_term_slug,
  ]);

  function goPrev($current_page)
  {
    if ($current_page > 1) {
      $current_page--;
    } else {
      $current_page = 1;
    }
    return '?page_num=' . $current_page;
  }

  function goNext($current_page, $total_pages)
  {
    if ($current_page < $total_pages) {
      $current_page++;
    } else {
      $current_page = $total_pages;
    }
    return '?page_num=' . $current_page;
  }

  require_once __DIR__ . '/../components/productItemComponent.php';
  ?>
  <div class="products-loop__wrap">
    <?php foreach ($products as $product) : ?>
      <?php
      $title = $product->get_title();
      $img = get_the_post_thumbnail_url($product->get_id());
      $price = $product->get_price();
      $link = $product->get_permalink();
      $short_description = $product->get_short_description();
      $sku = $product->get_sku();
      $info = get_field('info', $product->get_id());
      $middle_price = get_field('middle_price', $product->get_id());
      $price_result = !empty($middle_price) ? $middle_price . ' /kg' : $price . '€';
      ?>
      <div class="products-loop__item">
        <?php productItemComponent($title, $img, $price_result, $link, 'Scopri di più'); ?>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if ($total_pages > 1) : ?>
    <ul class="pagination">
      <li class="pagination__arrow">
        <a href="<?php echo goPrev($current_page); ?>">
          <?php get_template_part('template-parts/icons/icon-swiper'); ?>
        </a>
      </li>
      <?php for ($i = 0; $i < $total_pages; $i++) : ?>
        <li>
          <a class="<?php echo $i + 1 == $current_page ? 'active' : null; ?>" href="?page_num=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a>
        </li>
      <?php endfor; ?>
      <li class="pagination__arrow pagination__arrow--next">
        <a href="<?php echo goNext($current_page, $total_pages); ?>">
          <?php get_template_part('template-parts/icons/icon-swiper'); ?>
        </a>
      </li>
    </ul>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
