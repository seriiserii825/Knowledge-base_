<footer class="loop-products__footer">
  <div class="loop-products__price"><?php echo $price; ?>€/kg</div>
  <a href="#"
     data-id="<?php echo $product->get_id(); ?>"
     class="loop-products__add-to-cart">+ Aggiungi al carrello</a>
</footer>

<div class="main-header__circle main-header__cart-icon cart-icon" id="js-cart-icon">
    <div class="cart-icon-target">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_703_175)">
                <path d="M26.2094 9H5.79194C5.54614 8.99997 5.30881 9.08979 5.12463 9.25256C4.94045 9.41533 4.82213 9.63981 4.79194 9.88375L3.01069 24.8838C2.99421 25.0245 3.00784 25.1671 3.05066 25.3022C3.09348 25.4373 3.16453 25.5617 3.25908 25.6673C3.35363 25.7728 3.46954 25.8571 3.59912 25.9144C3.7287 25.9718 3.86899 26.001 4.01069 26H27.9907C28.1324 26.001 28.2727 25.9718 28.4023 25.9144C28.5318 25.8571 28.6477 25.7728 28.7423 25.6673C28.8369 25.5617 28.9079 25.4373 28.9507 25.3022C28.9935 25.1671 29.0072 25.0245 28.9907 24.8838L27.2094 9.88375C27.1792 9.63981 27.0609 9.41533 26.8767 9.25256C26.6926 9.08979 26.4552 8.99997 26.2094 9Z"
                      stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11 13V8C11 6.67392 11.5268 5.40215 12.4645 4.46447C13.4021 3.52678 14.6739 3 16 3C17.3261 3 18.5979 3.52678 19.5355 4.46447C20.4732 5.40215 21 6.67392 21 8V13"
                      stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
                <clipPath id="clip0_703_175">
                    <rect width="32" height="32" fill="white"/>
                </clipPath>
            </defs>
        </svg>
        <?php bsv_eccommerce_woocommerce_cart_link(); ?>
    </div>
    <?php the_widget('WC_Widget_Cart', 'title='); ?>
</div>

<script>
// custom-jquery.js
$('body').on('click', '.loop-products__add-to-cart', function(e) {
    e.preventDefault();
    const product_id = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: wc_add_to_cart_params.ajax_url,
        data: {
            action: 'add_to_cart',
            product_id: product_id,
        },
        success: function(response) {
            // You can handle the response here, e.g., show a success message
            console.log('Product added to the cart');
            // console.log(response, 'response')
            // $('.mini-cart-widget').html(response);
            $(document.body).trigger('wc_fragment_refresh');   
        }
    });
    // window.location.reload();
});
</script>
<?php
// add-to-cart-api.php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
function add_to_cart() {
    // Get the product ID from the AJAX request
    $product_id = intval($_POST['product_id']);

    // Add the product to the cart
    WC()->cart->add_to_cart($product_id);

    // Return a response
    WC_AJAX :: get_refreshed_fragments();
    // Make sure to exit
    wp_die();
}
add_action('wp_ajax_add_to_cart', 'add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart');

