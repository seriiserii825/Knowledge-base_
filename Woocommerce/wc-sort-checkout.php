<?php 
Первая (для блока оплаты) – это:

function sort_fields_billing($fields) {

	$fields["billing"]["billing_first_name"]["priority"] = 1;
	$fields["billing"]["billing_last_name"]["priority"] = 5;
	$fields["billing"]["billing_company"]["priority"] = 6;
	$fields["billing"]["billing_address_1"]["priority"] = 2;
	$fields["billing"]["billing_address_2"]["priority"] = 8;
	$fields["billing"]["billing_city"]["priority"] = 7;
	$fields["billing"]["billing_postcode"]["priority"] = 9;
	$fields["billing"]["billing_country"]["priority"] = 3;
	$fields["billing"]["billing_state"]["priority"] = 11;
	$fields["billing"]["billing_email"]["priority"] = 4;
	$fields["billing"]["billing_phone"]["priority"] = 10;
	
	return $fields;
	
}

add_filter("woocommerce_checkout_fields", "sort_fields_billing");
и вторая (для блока доставки):

function sort_fields_shipping($fields) {

	$fields["shipping"]["shipping_first_name"]["priority"] = 9;
	$fields["shipping"]["shipping_last_name"]["priority"] = 4;
	$fields["shipping"]["shipping_company"]["priority"] = 8;
	$fields["shipping"]["shipping_address_1"]["priority"] = 7;
	$fields["shipping"]["shipping_address_2"]["priority"] = 6;
	$fields["shipping"]["shipping_city"]["priority"] = 2;
	$fields["shipping"]["shipping_postcode"]["priority"] = 3;
	$fields["shipping"]["shipping_country"]["priority"] = 5;
	$fields["shipping"]["shipping_state"]["priority"] = 1;
	
	return $fields;
	
}

add_filter("woocommerce_checkout_fields", "sort_fields_shipping");

?>
