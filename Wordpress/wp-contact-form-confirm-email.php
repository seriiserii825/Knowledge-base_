<?php 
function custom_email_confirmation_validation_filter( $result, $tag ) {
    if ( 'your-email-confirm' == $tag->name ) {
        $your_email = isset( $_POST['your-email'] ) ? trim( $_POST['your-email'] ) : '';
        $your_email_confirm = isset( $_POST['your-email-confirm'] ) ? trim( $_POST['your-email-confirm'] ) : '';

        if ( $your_email != $your_email_confirm ) {
            $result->invalidate( $tag, "Are you sure this is the correct address?" );
        }
    }

    return $result;
}

?>

<div class="popup-form__group">
  <label for="email">Email</label>
  [email* your-email id:email]
</div>
<div class="popup-form__group">
  <label for="email">Conferma email</label>
  [email* your-email-confirm id:your-email-confirm]
</div>
