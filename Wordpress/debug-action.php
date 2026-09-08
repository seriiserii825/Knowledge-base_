<?php 
add_action( 'ywsbs_customer_subscription_renew_reminder_mail', 'some_function' );

function some_function( $var ) {
    error_log( var_export( $var, 1 ) );
}
// find debug in wp-content/debug.log
?>
