<?php
// Enqueue custom script for checkout and add AJAX action
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');
function custom_enqueue_scripts()
{
    if (is_checkout()) {
        wp_enqueue_script('custom-checkout', get_template_directory_uri() . '/js/custom-checkout.js', array('jquery'), null, true);
        wp_localize_script('custom-checkout', 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('custom_checkout_nonce')
        ));
    }
}

add_action('wp_ajax_update_checkout_fields', 'custom_update_checkout_fields');
add_action('wp_ajax_nopriv_update_checkout_fields', 'custom_update_checkout_fields');

function custom_update_checkout_fields()
{
    // Verify nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'custom_checkout_nonce')) {
        wp_send_json_error();
        return;
    }

    // Get the selected value from the AJAX request
    $select_value = isset($_POST['select_value']) ? sanitize_text_field($_POST['select_value']) : '';

    // Send success response (no server-side change is needed as jQuery handles it)
    wp_send_json_success([
        'select_value' => $select_value,
    ]);
}

// make all fields optional
add_filter('woocommerce_checkout_fields', 'custom_disable_billing_azienda_validation');
function custom_disable_billing_azienda_validation($fields)
{
    // Check if the field exists to avoid errors
    $fields['billing']['billing_azienda']['required'] = false;
    $fields['billing']['billing_p_iva']['required'] = false;
    $fields['billing']['billing_fiscal_code']['required'] = false;
    $fields['billing']['billing_codice_sdi']['required'] = false;

    return $fields;
}


// show errors messages on checkout
add_action('woocommerce_after_checkout_validation', 'custom_validate_checkout_fields', 10, 2);
function custom_validate_checkout_fields($posted)
{
    $billing_codice_extra = isset($posted['billing_codice_extra']) ? sanitize_text_field($posted['billing_codice_extra']) : '';

    // If "Yes" is selected, validate the custom_extra_field
    if ($billing_codice_extra === '') {
        if (empty($posted['billing_azienda'])) {
            wc_add_notice(__('<strong>Azienda</strong> di fatturazione è un campo obbligatorio.'), 'error');
        }
        if (empty($posted['billing_p_iva'])) {
            wc_add_notice(__('<strong>P.Iva</strong> di fatturazione è un campo obbligatorio.'), 'error');
        }
        if (empty($posted['billing_fiscal_code'])) {
            wc_add_notice(__('<strong>Codice Fiscale</strong> di fatturazione è un campo obbligatorio.'), 'error');
        }
        if (empty($posted['billing_codice_sdi'])) {
            wc_add_notice(__('<strong>Codice SDI</strong> di fatturazione è un campo obbligatorio.'), 'error');
        }
    }
}
