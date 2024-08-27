<?php
// inc/redirect_error.php
function prefix_redirect_error()
{
    static $errors = null;

    if (!$errors) {
        $errors = new Truongwp_Redirect_With_Error();
    }

    // $errors->register_error( 'error-code', 'error-message' );
    $errors->register_error('confirm_password', translateText('Le password non sono le stesse', 'Passwords are not the same'));
    $errors->register_error('register', translateText("L'utente esiste già", "User already exists"));

    return $errors;
}


// Validation and processing of registration form
function custom_process_registration()
{
    $create_page_url = get_the_permalink(521);
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['custom-registration-nonce'])) {
        if (wp_verify_nonce($_POST['custom-registration-nonce'], 'custom-registration')) {
            $user_login = sanitize_user($_POST['user_login']);
            $user_surname = sanitize_text_field($_POST['last_name']);
            $user_email = sanitize_email($_POST['user_email']);
            $user_password = $_POST['user_password'];
            $confirm_password = $_POST['confirm_password'];

            // Check if passwords match
            if ($user_password === $confirm_password) {
                // Additional validation and user creation logic can be added here

                //        $user_id = wp_create_user($user_login, $user_password, $user_email);
                $userdata = [
                    'user_login' => $user_login,      // (string) Имя пользователя для входа в систему.
                    'user_email' => $user_email,      // (string) Адрес электронной почты пользователя.
                    'first_name' => $user_login,      // (string) Имя пользователя.
                    'user_pass' => $user_password,
                    'last_name' => $user_surname,      // (string) Фамилия пользователя.
                    /* 'role'                 => '',      // (string) Роль пользователя. */
                ];

                $user_id = wp_insert_user($userdata);
                $user = new WP_User($user_id);
                $user->set_role('customer');

                update_user_meta($user_id, 'first_name', $user_login);
                update_user_meta($user_id, 'shipping_first_name', $user_login);

                update_user_meta($user_id, 'last_name', $user_surname);
                update_user_meta($user_id, 'shipping_last_name', $user_surname);

                // Add WooCommerce specific user meta.
                update_user_meta($user_id, 'first_name', $user_login);
                update_user_meta($user_id, 'shipping_first_name', $user_login);

                update_user_meta($user_id, 'last_name', $user_surname);
                update_user_meta($user_id, 'shipping_last_name', $user_surname);

                if (is_wp_error($user_id)) {
                    $new_url = prefix_redirect_error()->add_error($create_page_url, 'register');
                    wp_redirect($new_url);
                    exit();
                } else {
                    // Redirect to login page after successful registration
                    $customer_page_url = get_the_permalink(11);
                    wp_redirect($customer_page_url);
                    exit();
                }
            } else {
                $new_url = prefix_redirect_error()->add_error($create_page_url, 'confirm_password');
                wp_redirect($new_url);
                exit();
            }
        }
    }
}

add_action('init', 'custom_process_registration');

// page-create.php

?>
<?php
$create = get_field('create');
$personal = $create['personal'];
$info = $create['info'];
$privacy = $create['privacy'];
$submit = $create['submit'];
$login = $create['login'];

//register_new_user( 'serii', 'seriiburduja@gmail.com' );
?>
<div class="page-customer page-customer--register">
  <div class="container">
    <?php if (prefix_redirect_error()) : ?>
      <?php prefix_redirect_error()->show_error(); ?>
    <?php endif; ?>
    <h1 class="page-customer__title"><?php echo $personal; ?></h1>
    <div class="page-customer__form">
        <form id="custom-registration-form" action="<?php echo esc_url(site_url('wp-login.php?action=register', 'login_post')); ?>" method="post">
<!--      <form id="custom-registration-form" action="/wp-json/wp/v2/users/register" method="post">-->
        <div class="page-customer__wrap">
          <div class="page-customer__item">
            <h3 class="page-customer__subtitle"><?php echo $personal; ?></h3>
            <label for="user_login"><?php echo translateText('Nome', 'First Name') ?>:</label>
            <input type="text" name="user_login" id="user_login" required />
            <label for="last_name"><?php echo translateText('Cognome', 'Last Name') ?>:</label>
            <input type="text" name="last_name" id="last_name" required />
            <label class="page-customer__privacy">
              <input name="rememberme" type="checkbox" id="rememberme" value="forever">
              <?php echo $privacy; ?>
            </label>
          </div>
          <div class="page-customer__item">
            <h3 class="page-customer__subtitle"><?php echo $info; ?></h3>
            <label for="user_email">Email:</label>
            <input type="email" name="user_email" id="user_email" required />
            <label for="user_password">Password:</label>
            <input type="password" name="user_password" id="user_password" required />
            <label for="confirm_password"><?php echo translateText('Conferma password', 'Confirm Password')?>:</label>
            <input type="password" name="confirm_password" id="confirm_password" required />
            <?php wp_nonce_field('custom-registration', 'custom-registration-nonce'); ?>
            <footer class="page-customer__footer">
              <input type="submit" value="<?php echo $submit; ?>" />
              <a href="<?php echo get_the_permalink(11); ?>" class="page-customer__btn"><?php echo $login; ?></a>
            </footer>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
