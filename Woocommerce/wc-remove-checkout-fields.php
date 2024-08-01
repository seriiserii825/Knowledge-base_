<?php 

add_filter( 'woocommerce_checkout_fields', 'wpbl_remove_some_fields', 9999 );
 
function wpbl_remove_some_fields( $array ) {
 
    //unset( $array['billing']['billing_first_name'] ); // Имя
    //unset( $array['billing']['billing_last_name'] ); // Фамилия
    //unset( $array['billing']['billing_email'] ); // Email
    //unset( $array['order']['order_comments'] ); // Примечание к заказу
 
    unset( $array['billing']['billing_company'] ); // Компания
    // unset( $array['billing']['billing_phone'] ); // Телефон
    // unset( $array['billing']['billing_country'] ); // Страна
    // unset( $array['billing']['billing_address_1'] ); // 1-ая строка адреса 
    unset( $array['billing']['billing_address_2'] ); // 2-ая строка адреса 
    // unset( $array['billing']['billing_city'] ); // Населённый пункт
    // unset( $array['billing']['billing_state'] ); // Область / район
    // unset( $array['billing']['billing_postcode'] ); // Почтовый индекс
     
    // Возвращаем обработанный массив
    return $array;
}

?>
