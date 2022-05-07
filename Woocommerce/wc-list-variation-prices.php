<?php foreach ($product->get_available_variations() as $variation) : ?>
  <?php $variation_id = $variation['variation_id']; ?>
  <div class="product-variation variation-id-<?php echo $variation_id; ?>">
    <strong>Variation id</strong>: <?php echo $variation_id ?><br>;
    <?php $attributes = array(); ?>
    <?php foreach ($variation['attributes'] as $key => $value) : ?>
      <?php
      $taxonomy       = str_replace('attribute_', '', $key);
      $taxonomy_label = get_taxonomy($taxonomy)->labels->singular_name;
      $term_name      = get_term_by('slug', $value, $taxonomy)->name;
      $attributes[]   = $taxonomy_label . ': ' . $term_name;
      ?>
    <?php endforeach; ?>
    <span class="variation-attributes">
      <strong>Attributes</strong>: <?php echo implode(' | ', $attributes) ?></span><br>;
    <?php
    $active_price  = floatval($variation['display_price']);         // Active price
    $regular_price = floatval($variation['display_regular_price']); // Regular Price
    vardump($active_price);
    if ($active_price != $regular_price) {
      $sale_price = $active_price; // Sale Price
    }
    ?>
    <span class="variation-prices">
      <strong>Price</strong>: <?php echo $variation['price_html']; ?></span><br>
  </div>';
<?php endforeach; ?>
