<?php  
// Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

// Exclude notices and deprecations from logging
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// create plugin file in
// wp-content/mu-plugins/limit-error-reporting.php
?>


<?php
/**
 * Plugin Name: Limit Error Reporting (local)
 * Description: Exclude notices and deprecations from debug.log on local.
 */

// Only adjust on local + when WP_DEBUG is on.
if ( defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local' && defined('WP_DEBUG') && WP_DEBUG ) {

    // Remove notices, user notices, deprecated (incl. user) and strict.
    $level = E_ALL & ~E_NOTICE & ~E_USER_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_STRICT;
    error_reporting($level);

    // Prevent WordPress from triggering notice-level logs for “doing it wrong” and deprecated calls.
    add_filter('doing_it_wrong_trigger_error', '__return_false');
    add_filter('deprecated_function_trigger_error', '__return_false');
    add_filter('deprecated_argument_trigger_error', '__return_false');
    add_filter('deprecated_file_trigger_error', '__return_false');
}

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
