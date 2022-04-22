Woocommerce Javascript events
Woocommerce Checkout JS events
$( document.body ).trigger( 'init_checkout' );
$( document.body ).trigger( 'payment_method_selected' );
$( document.body ).trigger( 'update_checkout' );
$( document.body ).trigger( 'updated_checkout' );
$( document.body ).trigger( 'checkout_error' );
$( document.body ).trigger( 'applied_coupon_in_checkout' );
$( document.body ).trigger( 'removed_coupon_in_checkout' );
Woocommerce cart page JS events
$( document.body ).trigger( 'wc_cart_emptied' );
$( document.body ).trigger( 'update_checkout' );
$( document.body ).trigger( 'updated_wc_div' );
$( document.body ).trigger( 'updated_cart_totals' );
$( document.body ).trigger( 'country_to_state_changed' );
$( document.body ).trigger( 'updated_shipping_method' );
$( document.body ).trigger( 'applied_coupon', [ coupon_code ] );
$( document.body ).trigger( 'removed_coupon', [ coupon ] );
Woocommerce Single product page JS events
$( '.wc-tabs-wrapper, .woocommerce-tabs, #rating' ).trigger( 'init' );
Woocommerce Variable product page JS events
$( document.body ).trigger( 'found_variation', [variation] );
Woocommerce Add to cart JS events
$( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );
$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
$( document.body ).trigger( 'removed_from_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
$( document.body ).trigger( 'wc_cart_button_updated', [ $button ] );
$( document.body ).trigger( 'cart_page_refreshed' );
$( document.body ).trigger( 'cart_totals_refreshed' );
$( document.body ).trigger( 'wc_fragments_loaded' );
Woocommerce Add payment method JS events
$( document.body ).trigger( 'init_add_payment_method' );
To bind listener to these events, use:
jQuery('<event_target>').on('<event_name>', function(){
    console.log('<event_name> triggered');
});
F. ex.

jQuery('body').on('init_checkout', function(){
    console.log('init_checkout triggered');
    // now.do.whatever();
});
