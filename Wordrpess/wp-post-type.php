<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'init', 'my_custom_init' );
function my_custom_init() {
	register_post_type( 'soluzioni', array(
		'labels'             => array(
			'name'              => 'Soluzioni', // Основное название типа записи
			'singular_name'     => 'Soluzioni', // отдельное название записи типа Book
			'add_new'           => __( 'Add new' ),
			'add_new_item'      => __( 'Add new' ),
			'edit_item'         => __( 'Edit new' ),
			'new_item'          => __( 'New item' ),
			'view_item'         => __( 'View' ),
			'search_items'      => __( 'Search' ),
			'parent_item_colon' => '',
			'menu_name'         => 'Soluzioni'
		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'show_in_rest'       => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-index-card',
		'supports'           => array( 'title', 'thumbnail' )
	) );
}
