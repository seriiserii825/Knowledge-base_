<?php
$categories      = wp_get_post_categories( get_the_ID() );
$categories_sort = [];
?>
<?php foreach ( $categories as $cat ): ?>
	<?php $category = get_category( $cat ); ?>
	<?php $sort_number = get_field( 'sort_number', 'term_' . $category->term_id . '' ); ?>
	<?php $categories_sort[ $sort_number ] = $category->name; ?>
<?php endforeach; ?>
