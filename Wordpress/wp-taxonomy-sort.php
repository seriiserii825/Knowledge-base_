<?php
$terms = get_terms([
    'taxonomy' => 'categorie',
]);
$newterms = array();
foreach ($terms as $term) {
    $order = get_field('order', $term); //THIS MY CUSTOM FIELD VALUE
    $newterms[$order] = (object)array(
        'name' => $term->name,
        'slug' => $term->slug,
        'term_id' => $term->term_id,
        /* 'image' => get_field('image', $term) */
    );
    ksort( $newterms, SORT_NUMERIC );
}
?>
