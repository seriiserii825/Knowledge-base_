//remove_action( 'add_option_new_admin_email', 'update_option_new_admin_email' );
//remove_action( 'update_option_new_admin_email', 'update_option_new_admin_email' );
///**
// * Disable the confirmation notices when an administrator
// * changes their email address.
// *
// * @see http://codex.wordpress.com/Function_Reference/update_option_new_admin_email
// */
//function wpdocs_update_option_new_admin_email( $old_value, $value ) {
//	update_option( 'admin_email', $value );
//}
//add_action( 'add_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
//add_action( 'update_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
