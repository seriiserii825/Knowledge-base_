<?php $term = get_term(3, 'type'); ?>
$term_id = 21; // Lucky number :)

$child_term = get_term( $term_id, 'category' );
$parent_term = get_term( $child_term->parent, 'category' );


