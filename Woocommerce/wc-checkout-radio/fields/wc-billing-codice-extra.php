<?php
add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields_codice_extra');
function custom_woocommerce_billing_fields_codice_extra($fields)
{
  $fields['billing_codice_extra'] = array(
    'label' => __('Codice EXTRA', 'woocommerce'),
    'placeholder' => _x('Codice EXTRA', 'placeholder', 'woocommerce'),
    'required' => true,
    'clear' => false,
    'type' => 'text',
    // 'class' => array(''),
  );
  return $fields;
}
