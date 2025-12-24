<?php
$args = array(
    'post_type'     => 'post',
    'post_status'   => 'publish',
    'orderby' => $_POST['orderby'], 
    'order' => $_POST['order'],
    'search_prod_title' => $_POST['search'],
);
$query = new WP_Query($args);

// functions.php

add_filter( 'posts_where', 'title_filter', 10, 2 );
function title_filter($where, $wp_query)
{
  global $wpdb;
  
  // Check if this is a query for 'progetti' post type
  $post_type = $wp_query->get('post_type');
  
  // Only apply to 'progetti' post type
  if ($post_type !== 'progetti') {
    return $where;
  }
  
  if ($search_term = $wp_query->get('search_prod_title')) {
    $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\'';
  }
  
  return $where;
}
add_filter('posts_where', 'title_filter', 10, 2);
