<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	register_taxonomy( 'type', [ 'mobile' ], [
		'label'        => '',
		// определяется параметром $labels->name
		'labels'       => [
			'name'              => 'Shop',
			'singular_name'     => 'Shop',
			'search_items'      => 'Search Shop',
			'all_items'         => 'All Shop',
			'view_item '        => 'View Shop',
			'parent_item'       => 'Parent Shop',
			'parent_item_colon' => 'Parent Shop:',
			'edit_item'         => 'Edit Shop',
			'update_item'       => 'Update Shop',
			'add_new_item'      => 'Add New Shop',
			'new_item_name'     => 'New Shop Name',
			'menu_name'         => 'Shop',
		],
		'description'  => '',
		// описание таксономии
		'public'       => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical' => true,
		'rewrite'           => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'      => array(),
		'meta_box_cb'       => null,
		// html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column' => false,
		// авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'      => null,
		// добавить в REST API
		'rest_base'         => null,
		// $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}

$tax = get_taxonomy('category');
$labels = get_taxonomy_labels( $tax );
