<?php
add_filter('woocommerce_email_enabled_new_order',                '__return_false');
add_filter('woocommerce_email_enabled_customer_processing_order', '__return_false');
add_filter('woocommerce_email_enabled_customer_completed_order', '__return_false');
add_filter('woocommerce_email_enabled_customer_on_hold_order',   '__return_false');
add_filter('woocommerce_email_enabled_cancelled_order',          '__return_false');
