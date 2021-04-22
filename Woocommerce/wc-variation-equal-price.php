	<?php
	$args       = array(
		'post_type'   => 'product_variation',
		'post_status' => array( 'private', 'publish' ),
		'numberposts' => - 1,
		'orderby'     => 'menu_order',
		'order'       => 'ASC',
		'post_parent' => get_the_ID() // get parent post-ID
	);
	$variations = get_posts( $args );
	$prices     = [];
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
		$prices[]       = (float) $product_variation->get_price();
	}
	$count = array_unique( $prices );
	?>
	<?php if ( count( $count ) === 1 ): ?>
        <div class="variatons-equal-price">
            <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
            <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
        </div>
	<?php else: ?>
        <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	<?php endif; ?>
