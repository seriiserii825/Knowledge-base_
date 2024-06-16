<?php
$args = array(
    'post_type'     => 'post',
    'post_status'   => 'publish',
    'orderby' => $_POST['orderby'], 
    'order' => $_POST['order'],
    'search_prod_title' => $_POST['search'],
);
add_filter( 'posts_where', 'title_filter', 10, 2 );
$query = new WP_Query($args);
remove_filter( 'posts_where', 'title_filter', 10, 2 );

// functions.php
function title_filter( $where, &$wp_query ){
    global $wpdb;
    if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $search_term ) ) . '%\'';
    }
    return $where;
}
  ?>
