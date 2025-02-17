<?php


add_action('template_redirect', 'redirect_to_custom_thankyou_page');

function redirect_to_custom_thankyou_page()
{
  if (is_wc_endpoint_url('order-received')) {
    global $wp;
    $order_id = isset($wp->query_vars['order-received']) ? absint($wp->query_vars['order-received']) : 0;


    if ($order_id) {
      $order = wc_get_order($order_id);
      if (in_array($order->get_status(), ['on-hold', 'processing'])) {
        $order->update_status('completed', __('Order automatically marked as completed.', 'woocommerce'));
      }
      $custom_url = site_url('/custom-thank-you/?order_id=' . $order_id);
      wp_redirect($custom_url);
      exit;
    }
  }
}
