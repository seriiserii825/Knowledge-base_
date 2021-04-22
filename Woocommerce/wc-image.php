<?php 
//Remove single product image link
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'wc_remove_link_on_thumbnails' );
function wc_remove_link_on_thumbnails( $html ) {
	return strip_tags( $html, '<div><img>' );
}

function remove_zoom_woocommerce() {
	remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'after_setup_theme', 'remove_zoom_woocommerce', 100 );
// remove zoom in woocommerce.php

// Need to change image size for single product to bigger from single page, not gallery. 
-для изображения товара на странице каталога
add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
 return array(
 'width' => 500,
 'height' => 500,
 'crop' => 1,
 );
} );

- для большого изображения на странице товара


add_filter( 'woocommerce_get_image_size_single', function( $size ) {
 return array(
 'width' => 500,
 'height' => 500,
 'crop' => 1,
 );
} );

- для миниатюр в галерее на странице товара

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
 return array(
 'width' => 400,
 'height' => 400,
 'crop' => 1,
 );
} );

Для пересоздания миниатюр можно использовать плагин Force Regenerate Thumbnails .

add_theme_support( 'woocommerce', array(
	'thumbnail_image_width' => 500,
	'gallery_thumbnail_image_width' => 55,
	'single_image_width' => 1000,
) );
