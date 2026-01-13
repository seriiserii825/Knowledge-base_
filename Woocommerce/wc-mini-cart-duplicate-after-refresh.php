<?php
// in functions.php
// PRG (Post-Redirect-Get) паттерн — предотвращает дублирование при F5
add_action('template_redirect', function () {
  // Если это POST-запрос добавления в корзину на странице товара
  if (is_product() && !empty($_POST['add-to-cart'])) {
    // WooCommerce уже добавил товар, теперь делаем редирект
    $product_url = get_permalink();

    // Проверяем что товар был добавлен (нет ошибок)
    if (wc_notice_count('error') === 0) {
      wp_safe_redirect($product_url);
      exit;
    }
  }
}, 99);
