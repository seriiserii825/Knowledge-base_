<?php 

function PriceFormat($value, $sign){
	$clearDots = trim(preg_replace("/\.+/", "", $value));
	$nonFormat   = trim( preg_replace( "/[^0-9.]/", "", $clearDots ) );
	$priceFormat = number_format( $nonFormat, 0, ",", "." );
	return $sign.' ' . $priceFormat;
}

?>
