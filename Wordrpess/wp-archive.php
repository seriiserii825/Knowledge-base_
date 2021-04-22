<?php
function eventi_adjust_queries( $query ) {
	if ( ! is_admin() && is_post_type_archive( 'eventi' ) && $query->is_main_query() ) {
		$today = date( 'Ymd' );
		$query->set( 'posts_per_page', '-1' );
		$query->set( 'meta_key', 'eventi_date' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'ASC' );
		$query->set( 'meta_query', [
			[
				'key'     => 'eventi_date',
				'compare' => '>=',
				'value'   => $today,
				'type'    => 'numeric'
			]
		] );
	}
}
add_action( 'pre_get_posts', 'eventi_adjust_queries' );
