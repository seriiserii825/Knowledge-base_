<?php
// add new script in public_html
// run site with /custom-script.php
// after create new user, delete this file
require_once('wp-load.php');

$username = 'newadmin';
$password = 'securepassword123';
$email    = 'admin@example.com';

if (!username_exists($username) && !email_exists($email)) {
    $user_id = wp_create_user($username, $password, $email);
    $user = new WP_User($user_id);
    $user->set_role('administrator');
    echo "Admin user created successfully.";
} else {
    echo "User already exists.";
}
