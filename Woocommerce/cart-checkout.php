https://www.businessbloomer.com/woocommerce-cart-checkout-same-page/

Step 1: Add Cart Shortcode @ Checkout Page
First, you need to add the “woocommerce_cart” shortcode to the Checkout page. In this way we’re telling WooCommerce we want to have the cart table on top and the checkout form below it.

Update: 19/Oct/2018. In the first version of this tutorial I suggested to add the [woocommerce_cart] shortcode above the “woocommerce_checkout” shortcode on the Checkout page (screenshot). Unfortunately this creates a bug on the “Thank you page” after an order is placed. In fact, an “empty cart” message is displayed there, as the Checkout page content (which includes the cart shortcode) also displays on the Thank you page (not sure why!). So we need to find a way to load the [woocommerce_cart] shortcode on the Checkout page BUT not on the Thank you page. Here’s the fix, and yes, it’s a neat PHP snippet.

PHP Snippet: Display cart table above checkout form @ WooCommerce Checkout page

/**
 * @snippet       Display Cart @ Checkout Page Only - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_action( 'woocommerce_before_checkout_form', 'bbloomer_cart_on_checkout_page_only', 5 );
 
function bbloomer_cart_on_checkout_page_only() {
 
if ( is_wc_endpoint_url( 'order-received' ) ) return;
 
echo do_shortcode('[woocommerce_cart]');
 
}
With this tiny change, your new Checkout page will look like in the following screenshot. Please note – if you’re familiar with the Cart page layout, you might remember the “Cart Collaterals” section (i.e. “Cart Totals“, where subtotal, shipping and totals are displayed)… well, this is automatically hidden just because you’re using the two shortcodes on the same page. Isn’t this wonderful?


Cart & Checkout on Same Page: Checkout Page Preview
Step 2: Unset Cart Page @ WooCommerce Settings (Updated for Woo 3.7+)
Probably, the shortcode change alone is sufficient to get what you need (Cart and Checkout on the same page). However, a couple of tweaks are needed in case you really want to do it right.

In fact, if the Checkout is emptied (I mean, the Cart is emptied on the Checkout page), WooCommerce will redirect users to the Cart page and display the empty cart message (“Return to Shop”).

Now, our goal is to completely get rid of the Cart page so that users will never see it.

Update: 21/Aug/2019. Until WooCommerce 3.7 was possible to set the “Checkout” page as both “Cart” and “Checkout” pages. This is not possible any longer, so just follow the new instructions.

For this reason you need to unset the Cart page (under WooCommerce > Settings > Advanced) – simply click on the little “x” and “Save Changes”. Here’s the updated screenshot since WooCommerce 3.7:


Unsetting the Cart page from the WooCommerce settings (as of WooCommerce 3.7)
Step 3: Delete Cart Page @ WordPress Pages
No need of a screenshot here.

Now that the Cart page is not useful any longer, it’s time to delete it from your WordPress pages. Redirects are already in place and your cart table is already on the Checkout page, so there is no need to worry.

Go ahead and put the Cart page into the trash!

Step 4 (Bonus): Redirect Empty Checkout
Then there is a little workaround in case you don’t want to show an empty Checkout page if users access it directly or when the cart table is emptied.

For example, you might want to redirect empty carts to the homepage, or maybe to the shop page (or even better to the last viewed product), so that customers can start shopping again.

Here’s a little snippet for you – a little bonus – so you can redirect the empty checkout page to the homepage for example. Try it out!

PHP Snippet: Redirect Empty Cart @ WooCommerce Checkout with Cart

/**
 * @snippet       Redirect Empty Cart/Checkout - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=80321
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_action( 'template_redirect', 'bbloomer_redirect_empty_cart_checkout_to_home' );
 
function bbloomer_redirect_empty_cart_checkout_to_home() {
   if ( is_cart() && is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
      wp_safe_redirect( home_url() );
      exit;
   }
}
