<?php  
// Append Meta-query for stock
$query['meta_query'] = array(
    'key' => '_stock_status',
    'value' => 'instock',
    'compare' => '='
);

$from_home = ($filterby === 'all');

if ($from_home) {
    $query['title_filter'] = $search;
    $query['title_filter_relation'] = 'OR';
    $query['meta_query'][] = array(
        'relation' => 'OR',
        array('key' => 'product_info_autore', 'value' => $search, 'compare' => 'LIKE'),
        array('key' => 'product_info_editore', 'value' => $search, 'compare' => 'LIKE'),
        array('key' => 'product_info_isbn', 'value' => $search, 'compare' => 'LIKE'),
    );
//    vardump($query);
} elseif ($filterby) {
    if ($filterby === 'titolo') {
        $query['s'] = $search; // search by title directly
    } elseif ($filterby === 'codice_interno') {
        $query['meta_query'][] = array('key' => '_sku', 'value' => $search, 'compare' => '=');
    } else {
        $query['meta_query'][] = array(
            'key' => 'product_info_' . $filterby,
            'value' => $search,
            'compare' => 'LIKE'
        );
    }
}
