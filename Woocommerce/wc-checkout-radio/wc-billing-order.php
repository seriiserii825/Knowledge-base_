<?php

function order_fields($fields)
{
  $i = 0;

  $order = array(
    "billing_first_name",
    "billing_last_name",
    "billing_email",
    "billing_phone",
    "billing_country",
    "billing_address_1",
    "billing_postcode",
    "billing_state",
    "billing_city",
    "billing_company",
    "billing_address_2",
    "billing_fattura",
    "billing_azienda",
    "billing_codice_extra",
  );

  foreach ($order as $field) {
    $ordered_fields[$field] = $fields["billing"][$field];
    $custom_fields = ['billing_fattura', 'billing_azienda', 'billing_p_iva', 'billing_fiscal_code', 'billing_codice_sdi','billing_note_opzionale'];
    if (in_array($field, $custom_fields)) {
      $count = 1000 + $i;
      $ordered_fields[$field]["priority"] = $count;
      continue;
    } else {
      $ordered_fields[$field]["priority"] = ++$i;
    }
  }

  $fields["billing"] = $ordered_fields;

  return $fields;
}

add_filter("woocommerce_checkout_fields", "order_fields");

