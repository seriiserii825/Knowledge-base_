## connect in function.php 2 files

class-truongwp-redirect-with-error.php

```
<?php
/**
 * Class Truongwp_Redirect_With_Error
 *
 * Handle error when redirecting to other URL in WordPress.
 * Use simple URL parameter and nonce, don't use SESSION or COOKIE which not advised in WordPress.
 *
 * @package Truongwp_Redirect_With_Error
 */

/**
 * Class Truongwp_Redirect_With_Error
 */
class Truongwp_Redirect_With_Error {

	/**
	 * Assoc array with key is error code and value is error message.
	 *
	 * @var array
	 */
	protected $errors = array();

	/**
	 * Name of URL parameter for error.
	 *
	 * @var string
	 */
	protected $error_key = 'error-code';

	/**
	 * Name of URL parameter for nonce.
	 *
	 * @var string
	 */
	protected $nonce_key = 'token';

	/**
	 * Nonce action name.
	 *
	 * @var string
	 */
	protected $nonce_action = 'truongwp-redirect-with-error';

	/**
	 * Template for displaying error, use %1$s for error code and %2$s for error message.
	 *
	 * @var string
	 */
	protected $template = '<div class="alert alert-danger error-%1$s">%2$s</div>';

	/**
	 * Set new error key.
	 *
	 * @param string $key New error key.
	 */
	public function set_error_key( $key ) {
		$this->error_key = $key;
	}

	/**
	 * Set new nonce key.
	 *
	 * @param string $key New nonce key.
	 */
	public function set_nonce_key( $key ) {
		$this->nonce_key = $key;
	}

	/**
	 * Set new nonce action name,
	 *
	 * @param string $action New nonce action name.
	 */
	public function set_nonce_action( $action ) {
		$this->nonce_action = $action;
	}

	/**
	 * Set new template markup.
	 *
	 * @param string $template New template markup.
	 */
	public function set_template( $template ) {
		$this->template = $template;
	}

	/**
	 * Register an error,
	 *
	 * @param string $error_code    Error code.
	 * @param string $error_message Error message.
	 */
	public function register_error( $error_code, $error_message ) {
		$this->errors[ $error_code ] = strval( $error_message );
	}

	/**
	 * Get error message from error code.
	 *
	 * @param string $error_code Error code.
	 * @return string|false Error message. False if error code is not exists.
	 */
	public function get_error( $error_code ) {
		if ( isset( $this->errors[ $error_code ] ) ) {
			return $this->errors[ $error_code ];
		}

		return false;
	}

	/**
	 * Pass an error to URL.
	 *
	 * @param string $url        Redirect URL.
	 * @param string $error_code Error code.
	 * @return string URL with error.
	 */
	public function add_error( $url, $error_code ) {
		$nonce = wp_create_nonce( $this->nonce_action );

		$new_url = add_query_arg( array(
			$this->error_key => $error_code,
			$this->nonce_key => $nonce,
		), $url );
		return $new_url;
	}

	/**
	 * Display error.
	 *
	 * @param string $code Only display a specific error code. Default is null.
	 * @param bool   $echo Print error of return.
	 * @return string|null Error HTML if $echo is false.
	 */
	public function show_error( $code = null, $echo = true ) {
		if ( empty( $_GET[ $this->error_key ] ) || empty( $_GET[ $this->nonce_key ] ) ) {
			return;
		}

		// Verify nonce to prevent error displayed when only pass error code to URL.
		$nonce = $_GET[ $this->nonce_key ]; // WPCS: sanitization ok.
		if ( ! wp_verify_nonce( $nonce, $this->nonce_action ) ) {
			return;
		}

		$error_code = sanitize_text_field( wp_unslash( $_GET[ $this->error_key ] ) );

		if ( $code && $error_code !== $code ) {
			return;
		}

		$error_message = $this->get_error( $error_code );
		if ( ! $error_message ) {
			return;
		}

		$html = sprintf(
			$this->template,
			esc_attr( $error_code ),
			wp_kses_post( $error_message )
		);

		if ( $echo ) {
			echo wp_kses_post( $html );
		}

		return $html;
	}
}
```

redirect_error.php

```
<?php
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
  $create_page_url = get_the_permalink(445);
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['custom-registration-nonce'])) {
    if (wp_verify_nonce($_POST['custom-registration-nonce'], 'custom-registration')) {
      $user_login = sanitize_user($_POST['user_login']);
      $user_email = sanitize_email($_POST['user_email']);
      $user_password = $_POST['user_password'];
      $confirm_password = $_POST['confirm_password'];

      // Check if passwords match
      if ($user_password === $confirm_password) {
        // Additional validation and user creation logic can be added here

        $user_id = wp_create_user($user_login, $user_password, $user_email);

        if (is_wp_error($user_id)) {
          $new_url = prefix_redirect_error()->add_error($create_page_url, 'register');
          wp_redirect($new_url);
          exit();
        } else {
          // Redirect to login page after successful registration
          $customer_page_url = get_the_permalink(428);
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
```

### add errors

in prefix_redirect_error()

```

$errors->register_error('confirm_password', translateText('Le password non sono le stesse', 'Passwords are not the same'));
```

### use errors

in custom_process_registration()

```

$new_url = prefix_redirect_error()->add_error($create_page_url, 'register');
wp_redirect($new_url);
```

### display errors

```

    <?php if (prefix_redirect_error()) : ?>
      <?php prefix_redirect_error()->show_error(); ?>
    <?php endif; ?>
```

### or show specific error
```
<?php
prefix_redirect_error()->show_error( 'error-1' );
```
