<?php 
add_filter('woocommerce_available_variation', function($available_variations, \WC_Product_Variable $variable, \WC_Product_Variation $variation) {
    if (empty($available_variations['price_html'])) {
        $available_variations['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }

    return $available_variations;
}, 10, 3);
