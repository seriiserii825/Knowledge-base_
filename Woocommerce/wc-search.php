<?php
//funct.php
add_filter('woocommerce_product_data_store_cpt_get_products_query', 'handle_custom_query_var', 10, 2);
function handle_custom_query_var($query, $query_vars)
{
  if (isset($query_vars['like_name']) && !empty($query_vars['like_name'])) {
    $query['s'] = esc_attr($query_vars['like_name']);
  }

  return $query;
}

//api file
$products_posts = wc_get_products([
  'like_name' => $title,
]);

// posts

function title_filter($where, $wp_query)
{
  global $wpdb;
  if ($search_term = $wp_query->get('title_filter')) :
    $search_term = $wpdb->esc_like($search_term);
    $search_term = ' \'%' . $search_term . '%\'';
    $title_filter_relation = (strtoupper($wp_query->get('title_filter_relation')) == 'OR' ? 'OR' : 'AND');
    $where .= ' ' . $title_filter_relation . ' ' . $wpdb->posts . '.post_title LIKE ' . $search_term;
  endif;
  return $where;
}
add_filter('posts_where', 'title_filter', 10, 2);

$posts_items = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => -1,
  'title_filter' => $title,
]);
