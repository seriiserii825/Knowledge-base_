<?php
$args = array(
  'post_type'     => 'product_variation',
  'post_status'   => array( 'private', 'publish' ),
  'numberposts'   => -1,
  'orderby'       => 'menu_order',
  'order'         => 'ASC',
  'post_parent'   => get_the_ID() // get parent post-ID
);
$variations = get_posts( $args ); 
 
foreach ( $variations as $variation ) {
  
  // get variation ID
  $variation_ID = $variation->ID;
 
  // get variations meta
  $product_variation = new WC_Product_Variation( $variation_ID );
 
  // get variation featured image
  $variation_image = $product_variation->get_image();
 
  // get variation price
  $variation_price = $product_variation->get_price_html();
       //get variation name
  $variation_name = $product_variation->get_variation_attributes();
echo "<p class='product_price' >";
echo $variation_name["KEY"].": ";
echo ($variation_price);
echo "</p>";
}
