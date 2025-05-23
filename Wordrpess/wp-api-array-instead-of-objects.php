<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
function region_register_search()
{
    register_rest_route('regions/v1', 'regions', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'regionSearchResults',
    ]);
}

add_action('rest_api_init', 'region_register_search');
function regionSearchResults()
{
    $regions_result = [];
    $terms = get_terms([
        'taxonomy' => 'region',
        'hide_empty' => true,
    ]);
    foreach ($terms as $term) {
        $regions_result[] = $term;
    }
    $regions_result = array_values(array_map(function ($term) {
        return [
            'id' => $term->term_id,
            'name' => $term->name,
            'slug' => $term->slug,
        ];
    }, $terms));
    return $regions_result;
}
