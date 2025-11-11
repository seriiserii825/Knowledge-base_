<?php  
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

// Логировать без Notice/Deprecated. Хочешь — убери и Warning.
error_reporting(
  E_ALL
    & ~E_NOTICE
    & ~E_USER_NOTICE
    & ~E_DEPRECATED
    & ~E_USER_DEPRECATED
  // & ~E_WARNING
  // & ~E_USER_WARNING
);
?>

<!-- чтобы заглушить notice в debug.log -->
<!-- wp-content/mu-plugins/silence-doing-it-wrong.php -->
<?php
/**
 * Plugin Name: Silence Doing It Wrong Notices
 * Description: Disables _doing_it_wrong() trigger_error notices.
 */

add_filter('doing_it_wrong_trigger_error', '__return_false');                // _doing_it_wrong()
add_filter('deprecated_function_trigger_error', '__return_false');           // deprecated_function_run
add_filter('deprecated_argument_trigger_error', '__return_false');           // deprecated_argument_run
add_filter('deprecated_file_trigger_error', '__return_false');               // deprecated_file_included

?>
<?php

//func.php
if (!function_exists('write_log')) {

    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }

}

write_log('THIS IS THE START OF MY CUSTOM DEBUG');
//i can log data like objects
<!-- write_log($whatever_you_want_to_log); -->

<!-- call function and see log in debug.log  -->
error_log(print_r(array_keys($fields), true));
