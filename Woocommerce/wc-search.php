<?php
//funct.php
add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'handle_custom_query_var', 10, 2 );
function handle_custom_query_var( $query, $query_vars ) {
    if ( isset( $query_vars['like_name'] ) && ! empty( $query_vars['like_name'] ) ) {
        $query['s'] = esc_attr( $query_vars['like_name'] );
    }

    return $query;
}

//api file
$products_posts = wc_get_products([
    'like_name' => $title,
]);
