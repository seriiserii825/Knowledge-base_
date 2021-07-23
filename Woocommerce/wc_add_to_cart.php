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
                                                <?php
                                                echo apply_filters(
                                                      'woocommerce_loop_add_to_cart_link',
                                                      sprintf(
                                                            '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s ajax_add_to_cart product_type_%s woocommerce-LoopProduct-link">%s</a>',
                                                            esc_url($product->add_to_cart_url()),
                                                            esc_attr($product->get_id()),
                                                            esc_attr($product->get_sku()),
                                                            $product->is_purchasable() ? 'add_to_cart_button' : '',
                                                            esc_attr($product->product_type),
                                                            esc_html($product->add_to_cart_text())
                                                      ),
                                                      $product
                                                ); ?>
