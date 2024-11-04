<?php
add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields_azienda');
function custom_woocommerce_billing_fields_azienda($fields)
{
  $fields['billing_azienda'] = array(
    'label' => __('Azienda', 'woocommerce'),
    'placeholder' => _x('Azienda', 'placeholder', 'woocommerce'),
    'required' => true,
    'clear' => false,
    'type' => 'text',
    // 'class' => array(''),
  );
  return $fields;
}
add_action('woocommerce_checkout_update_order_meta', 'true_save_field_azienda', 25);
function true_save_field_azienda($order_id)
{
  if (!empty($_POST['billing_azienda'])) {
    update_post_meta($order_id, 'billing_azienda', sanitize_text_field($_POST['billing_azienda']));
  }
}
// Display field in order
add_action('woocommerce_admin_order_data_after_billing_address', 'office_true_print_field_azienda_value', 25);
function office_true_print_field_azienda_value($order)
{
  if ($method = get_post_meta($order->get_id(), 'billing_azienda', true)) {
    echo '<p><strong>Azienda: </strong><br>' . esc_html($method) . '</p>';
  }
}
