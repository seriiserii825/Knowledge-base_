<?php
function formatAttributes()
{
	global $product;
	$formatted_attributes = array();
	$attributes           = $product->get_attributes();
	foreach ($attributes as $attr => $attr_deets) {
		$attribute_label = wc_attribute_label($attr);
		if (isset($attributes[$attr]) || isset($attributes['pa_' . $attr])) {
			$attribute = isset($attributes[$attr]) ? $attributes[$attr] : $attributes['pa_' . $attr];
			if ($attribute['is_taxonomy']) {
				$formatted_attributes[$attribute_label] = implode(', ', wc_get_product_terms($product->id, $attribute['name'], array('fields' => 'names')));
			} else {
				$formatted_attributes[$attribute_label] = $attribute['value'];
			}
		}
	}
	return $formatted_attributes;
}

if ($product->is_type('variable')) {
	$args       = array(
		'post_type'   => 'product_variation',
		'post_status' => array('private', 'publish'),
		'numberposts' => -1,
		'orderby'     => 'menu_order',
		'order'       => 'asc',
		'post_parent' => get_the_ID() // get parent post-ID
	);
	$variations = get_posts($args);
	foreach ($variations as $variation) {
		// get variation ID
		$variation_ID = $variation->ID;
		// get variations meta
		$product_variation = new WC_Product_Variation($variation_ID);
		// get variation featured image
		$variation_image = $product_variation->get_image();
		// get variation price
		$variation_price = $product_variation->get_price();
		get_post_meta($variation_ID, '_text_field_date_expire', true);
		$attributes = $product_variation->attributes;
		if ($attributes['bottiglia'] == 'da 0,75 lt') {
			$price = $product_variation->get_regular_price();
		}
	}
} else {
	$price           = get_post_meta(get_the_ID(), '_regular_price', true);
}
