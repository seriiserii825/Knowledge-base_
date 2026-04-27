<?php
// in funcions.php after remove code
add_action('init', function () {
  $new_email = 'webmaster@altuofianco.it';
  if (get_option('admin_email') !== $new_email) {
    update_option('admin_email', $new_email);
  }
});
