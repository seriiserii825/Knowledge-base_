<?php
/* To add products to the WooCommerce cart with AJAX in WordPress, you can follow these steps: */

/* Enqueue jQuery Library: First, ensure that the jQuery library is enqueued in your WordPress theme. You can do this in your theme's functions.php file by adding the following code: */
function enqueue_jquery() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');
/* Create a Custom JavaScript File: Next, create a custom JavaScript file in your theme directory (e.g., custom.js) and enqueue it in your theme's functions.php file like this: */
/* Copy */
function enqueue_custom_js() {
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_js');
/* Write AJAX Function: In your custom.js file, you can write a function to handle the AJAX request. Here's an example of how you can add a product to the cart using AJAX: */
/* Copy */
jQuery(document).ready(function($) {
    $('body').on('click', '.add-to-cart-button', function() {
        var product_id = $(this).data('product-id');

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
            }
        });
    });
});
/* Create PHP Function for AJAX: In your theme's functions.php or in a custom plugin, you need to create a PHP function to handle the AJAX request. Here's an example: */
/* Copy */
function add_to_cart() {
    // Get the product ID from the AJAX request
    $product_id = intval($_POST['product_id']);

    // Add the product to the cart
    WC()->cart->add_to_cart($product_id);

    // Return a response
    echo 'success';

    // Make sure to exit
    die();
}
add_action('wp_ajax_add_to_cart', 'add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart');
/* HTML Markup: In your template, you can add a button to trigger the AJAX request. For example: */
/* Copy */
<button class="add-to-cart-button" data-product-id="123">Add to Cart</button>
