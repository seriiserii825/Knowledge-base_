<?php
add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields');

function custom_woocommerce_billing_fields($fields)
{
  $fields['billing_fattura'] = array(
    'label' => __('Fattura', 'woocommerce'),
    'placeholder' => _x('Fattura', 'placeholder', 'woocommerce'),
    'required' => true,
    'clear' => false,
    'type' => 'radio',
    'class' => array('wc-billing-radio'),
    'options' => array(
      'Si' => __('Si', 'woocommerce'),
      'No' => __('No', 'woocommerce'),
    ),
    'default' => 'Si'
  );

  return $fields;
}
add_action('woocommerce_checkout_update_order_meta', 'true_save_field', 25);
function true_save_field($order_id)
{
  if (!empty($_POST['billing_fattura'])) {
    update_post_meta($order_id, 'billing_fattura', sanitize_text_field($_POST['billing_fattura']));
  }
}
