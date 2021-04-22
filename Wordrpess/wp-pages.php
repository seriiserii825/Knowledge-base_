<?php 

$page_id         = get_the_ID();
$page_parrent_id = wp_get_post_parent_id( $page_id );
?>

<?php $childOf = null; ?>
<?php if ( $page_parrent_id ): ?>
	<?php $childOf = $page_parrent_id; ?>
<?php else: ?>
	<?php $childOf = $page_id; ?>
<?php endif; ?>

<?php wp_list_pages( [
	'title_li'    => null,
	'child_of'    => $childOf,
	'sort_column' => 'menu_order'// sorted by order for attribute page.
] ); ?>


<?php
$testArray = get_pages( [
'child_of' => $page_id
] );
if ( $page_parrent_id || $testArray ): ?>
