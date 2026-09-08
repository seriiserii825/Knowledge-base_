<?php 
function add_services_custom_order( $columns ) {
    $columns['custom_order'] = 'Custom Order'; // Column header name
    return $columns;
}
add_filter( 'manage_edit-servizi_columns', 'add_services_custom_order' );

function display_services_custom_order( $column, $post_id ) {
    if ( $column === 'custom_order' ) {
        echo get_post_meta( $post_id, 'single_service_order', true ) ?: '—'; // Adjust to actual meta key
    }
}
add_action( 'manage_servizi_posts_custom_column', 'display_services_custom_order', 10, 2 );
