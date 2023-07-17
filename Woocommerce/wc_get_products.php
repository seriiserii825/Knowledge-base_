<?php
/* Here are a few examples: */

// Get downloadable products created in the year 2016.
$products = wc_get_products( array(
'downloadable' => true,
'date_created' => '2016-01-01...2016-12-31',
) );
//
// Get draft products.
$args = array(
'status' => 'draft',
'type' => 'external',
'include' => array( 134, 200, 210, 340 ),
'exclude' => array( $product->get_id() ),
'parent' => 20,
'parent_exclude' => array( 20, 21 ),
'limit' => 3,
'page' => 1,
'limit' => 4,
'offset' => 1,
'paginate' => true,
'orderby' => 'modified',
'order' => 'DESC',
'orderby' => 'rand',
);
