	wp_deregister_script( 'wc-add-to-cart' );
	wp_enqueue_script( 'wc-add-to-cart', get_template_directory_uri() . '/woocommerce/js/add-to-cart.js', array(
		'jquery',
		'woocommerce',
		'wc-country-select',
		'wc-address-i18n'
	), null, true );

function wc_estore_woocommerce_cart_link in inc/woocommerce.php for mini-cart icon

#MINI-CART
<?php the_widget('WC_Widget_Cart', 'title='); ?>


// redirect to checkout page
add_filter( 'add_to_cart_redirect', 'redirect_to_checkout' );
function redirect_to_checkout() {
	global $woocommerce;
	$checkout_url = $woocommerce->cart->get_checkout_url();
	return $checkout_url;
}
