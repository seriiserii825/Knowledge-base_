### functions.php

add_filter('woocommerce_product_data_store_cpt_get_products_query', 'handle_price_range_query_var', 10, 2);
function handle_price_range_query_var($query, $query_vars)
{
    if (!empty($query_vars['price_range'])) {
        $price_range = explode('|', esc_attr($query_vars['price_range']));

        if (is_array($price_range) && count($price_range) == 2) {
            $query['meta_query']['relation'] = 'AND';

            $query['meta_query'][] = array(
                    'key' => '_price',
                    'value' => reset($price_range), // From price value
                    'compare' => '>=',
                    'type' => 'NUMERIC'
            );

            $query['meta_query'][] = array(
                    'key' => '_price',
                    'value' => end($price_range), // To price value
                    'compare' => '<=',
                    'type' => 'NUMERIC'
            );

            $query['orderby'] = 'meta_value_num'; // sort by price
            $query['order'] = 'ASC'; // In ascending order
        }
    }
    return $query;
}

### api 

<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
function products_api()
{
    register_rest_route('products/v1', 'list', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'productsApi',
    ]);
}

add_action('rest_api_init', 'products_api');
function productsApi($data)
{
    $limit = $data['limit'];
    $offset = $data['offset'];
    $category_slug = $data['category_slug'];
    $price_range = $data['price_range'];
    $paginate_args = array(
        'paginate' => true,
    );
    $results = wc_get_products($paginate_args);

    if (!empty($category_slug)) {
        $args = array(
            'limit' => $limit,
            'offset' => $offset,
            'category' => array($category_slug),
            'price_range' => $price_range,
        );
    } else {
        $args = array(
            'limit' => $limit,
            'offset' => $offset,
            'price_range' => $price_range,
        );
    }

    $data = wc_get_products($args);
    $product_list = array();
    foreach ($data as $product) {
        if (!empty(get_the_post_thumbnail_url($product->get_id()))) {
            $img = get_the_post_thumbnail_url($product->get_id());
        } else {
            $img = "";
        }

        $product_list[] = array(
            'id' => $product->get_id(),
            'title' => $product->get_title(),
            'slug' => $product->get_slug(),
            'regular_price' => $product->get_regular_price(),
            'sale_price' => $product->get_sale_price(),
            'price' => $product->get_price(),
            'img' => $img,
            'rating' => $product->get_average_rating(),
            'stock_quantity' => $product->get_stock_quantity(),
            'stock' => $product->is_in_stock(),
        );
    }

    return [
        'products' => json_encode($product_list),
        'results' => json_encode($results)
    ];
}
