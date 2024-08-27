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

    // results array for pagination
    if (!empty($category_slug)) {
        $paginate_args = array(
            'limit' => $limit,
            'category' => array($category_slug),
            'price_range' => $price_range,
            'paginate' => true,
            'offset' => $offset,
        );
    } else {
        $paginate_args = array(
            'limit' => $limit,
            'price_range' => $price_range,
            'paginate' => true,
            'offset' => $offset,
        );
    }
    $results = wc_get_products($paginate_args);

    // products array
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
            'novita' => get_field('novita', $product->get_id()),
            'price' => $product->get_price(),
            'img' => $img,
            'rating' => $product->get_average_rating(),
            'stock_quantity' => $product->get_stock_quantity(),
            'stock' => $product->is_in_stock(),
        );
    }

    return [
        'products' => $product_list,
        'results' => $results
    ];
}

