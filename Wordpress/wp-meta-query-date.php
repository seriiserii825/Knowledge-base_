<?php
$date_now = date('Y-m-d');

$volantino = new WP_Query([
  'post_type' => 'cataloghi',
  'posts_per_page' => -1,
  'post_status' => array('publish'),
  'meta_query'     => array(
    array(
      'key'     => 'data_fine_pubblicazione',
      'value'   =>  $date_now,
      'type'      =>  'date',
      'compare' =>  '>='

    )
  ),
  'tax_query' => [
    [
      'taxonomy' => 'categoria_volantino',
      'field' => 'term_id',
      'terms' => $term_id,
    ],
  ],
]);

$posts = $volantino->posts;
$total_posts = $volantino->found_posts;

// compare by select multiple

$query['meta_query'] = [
  [
    'key' => 'filter_usace',
    'value' => $filter_usace,
    'type' => 'CHAR',
    'compare' => 'LIKE'
  ]
];
