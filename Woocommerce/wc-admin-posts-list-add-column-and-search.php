<?php
add_filter('posts_search', 'custom_product_search_by_acf', 10, 2);
function custom_product_search_by_acf($search, $wp_query)
{
    global $wpdb;

    // Only apply to admin product search in WooCommerce
    if (is_admin() && isset($wp_query->query['post_type']) && $wp_query->query['post_type'] === 'product') {
        if (isset($_GET['s']) && $_GET['s']) {
            $search_term_get = $_GET['s'];
//            $search_term_get = get_query_var('s');
            $search_term = esc_sql($wpdb->esc_like($search_term_get));
//            $search_term_get = "' and birth_date < '2007-10-10'";
//            wp_die($search_term);

            $acf_meta_keys = ['product_info_isbn']; // Replace with your ACF field names
            $meta_query = [];
            foreach ($acf_meta_keys as $key) {
                $meta_query[] = "{$wpdb->postmeta}.meta_key = '{$key}' AND {$wpdb->postmeta}.meta_value LIKE '%{$search_term}%'";
            }

            $search .= " OR EXISTS (
                 SELECT 1 FROM {$wpdb->postmeta}
                 WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
                 AND (" . implode(' OR ', $meta_query) . ")
             )";
        }
    }

    return $search;
}


add_filter('manage_edit-product_columns', 'add_acf_column');
function add_acf_column($columns)
{
    $columns['product_info_isbn'] = __('ISBN'); // Display "ISBN" in the column header
    return $columns;
}


add_action('manage_product_posts_custom_column', 'show_acf_column_data', 10, 2);
function show_acf_column_data($column, $post_id)
{
    if ($column === 'product_info_isbn') {
        // Get ACF field value using the field name
        $isbn = get_field('product_info_isbn', $post_id);
        echo $isbn ? esc_html($isbn) : '—'; // Display value or a dash if empty
    }
}
