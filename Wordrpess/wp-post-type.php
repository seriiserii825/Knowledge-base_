<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'my_custom_init' );
function my_custom_init() {
	register_post_type( 'prodotti', array(
		'labels'             => array(
			'name'              => __( 'Prodotti' ), // Основное название типа записи
			'singular_name'     => __( 'Prodotti' ), // отдельное название записи типа Book
			'add_new'           => __( 'Add new' ),
			'add_new_item'      => __( 'Add new' ),
			'edit_item'         => __( 'Edit new' ),
			'new_item'          => __( 'New item' ),
			'view_item'         => __( 'View' ),
			'search_items'      => __( 'Search' ),
			'parent_item_colon' => '',
			'menu_name'         => __( 'Prodotti' )
		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'menu_icon'          => get_template_directory_uri() . '/assets/i/static/product.png',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
	) );
}


get_post_type_object('applicazioni')->label;
?>

<?php
$today  = date( 'Ymd' );
$events = new WP_Query( [
	'posts_per_page' => - 1,
	'post_type'      => 'events',
	'meta_key'       => 'event_date',
	'orderby'        => 'meta_value_num',
	'order'          => 'ASC',
	'meta_query'     => [
		[
			'key'     => 'event_date',
			'compare' => '>=',
			'value'   => $today,
			'type'    => 'numeric'
		],
		[
			'key'     => 'related_programs',
			'compare' => 'LIKE',
			'value'   => '"' . get_the_ID() . '"'
		],
	]
] ); 
