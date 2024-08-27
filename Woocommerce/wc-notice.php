<?php 
add_filter( 'wc_add_to_cart_message', 'handler_function_name', 10, 2 );
function handler_function_name( $message, $product_id ) {
	return "Thank you for adding product" . $product_id;
}

?>
