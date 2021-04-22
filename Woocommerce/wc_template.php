Основные шаблоны
archive-product.php — шаблон главного цикла вывода товаров
content-product.php — шаблон вывода товара, woocommerce_content()
content-product_cat.php — шаблон вывода товара в категории, шорткод [product_categories]. woocommerce_product_subcategories()
content-single-product.php — шаблон вывода одиночного товара, woocommerce_content()
content-widget-product.php — шаблон вывода товара в стандартных виджетах
product-searchform.php — шаблон формы поиска товаров, get_product_search_form()
single-product.php основной — шаблон карточки товара
single-product-reviews.php — шаблон вывода комментариев
taxonomy-product_cat.php — шаблон выводит товары категории, вызывает archive-product.php
taxonomy-product_tag.php — шаблон выводит товары метки, вызывает archive-product.php
Шаблоны при работе с «корзиной» покупок
cart\cart.php — шаблон вывода корзины с помощью шорткода, WC_Shortcode_Cart:utput()
cart\cart-empty.php — шаблон вывода пустой корзины с помощью шорткода, WC_Shortcode_Cart:utput()
cart\cart-item-data.php — шаблон элементов данных + вариаций в корзине, WC_Cart::get_item_data()
cart\cart-shipping.php — шаблон получения методов доставки в корзине, wc_cart_totals_shipping_html()
cart\cart-totals.php — шаблон итоговых сумм, woocommerce_cart_totals()
cart\cross-sells.php — шаблон перекрестных продаж, woocommerce_cross_sell_display()
cart\mini-cart.php — шаблон вывода мини-корзины в виджете, woocommerce_mini_cart()
cart\shipping-calculator.php — шаблон калькулятора доставки, woocommerce_shipping_calculator()
Шаблоны при оформлении заказа
checkout\cart-errors.php — шаблон ошибок при оформлении заказа, WC_Shortcode_Checkout::checkout()
checkout\form-billing.php — шаблон формы платежной информации, WC_Shortcode_Checkout::checkout()
checkout\form-checkout.php — шаблон формы оформления заказа , WC_Shortcode_Checkout::checkout()
checkout\form-coupon.php — шаблон формы купона, woocommerce_checkout_coupon_form()
checkout\form-login.php — шаблон формы логина при оформлении заказа, woocommerce_checkout_login_form()
checkout\form-pay.php — шаблон формы оплаты, WC_Shortcode_Checkout:rder_pay()
checkout\form-shipping.php — шаблон формы доставки, WC_Checkout::checkout_form_shipping()
checkout\payment.php — шаблон оплаты при оформлении заказа, woocommerce_checkout_payment
checkout\payment-method.php — шаблон вывода метода оплаты, из шаблона checkout\payment.php
checkout\review-order.php — шаблон таблицы заказа, woocommerce_order_review()
checkout\thankyou.php — шаблон вывода сообщений при оформлении заказа, WC_Shortcode_Checkout:rder_received()
Шаблоны сообщений по электронной почте
Формат (текстовый или html) определяется параметром «Тип письма» для конкретного вида электронного письма
emails\plain\admin-cancelled-order.php — шаблон электронного письма админу об отмененном заказе в текстовом формате, класс WC_Email_Cancelled_Order
emails\plain\admin-new-order.php — шаблон электронного письма админу о новом заказе в текстовом формате, класс WC_Email_New_Order
emails\plain\customer-completed-order.php — шаблон электронного письма о завершении отправляется клиентам во время пометки заказов как выполненные и обычно отражают факт успешной доставки в текстовом формате, класс WC_Email_Customer_Completed_Order
emails\plain\customer-invoice.php — шаблон электронного письма со счетом на оплату отправляется клиентам и содержит информацию о заказе и ссылки для оплаты в текстовом формате, класс WC_Email_Customer_Invoice
emails\plain\customer-new-account.php — шаблон электронного письма о создании учетной записи отправляется клиенту после создания учетной записи на страницах оплаты или учетной записи в текстовом формате, класс WC_Email_Customer_New_Account
emails\plain\customer-note.php — шаблон электронного письма с заметкой отправляется клиенту, когда вы добавляете заметку к заказу в текстовом формате, класс WC_Email_Customer_Note
emails\plain\customer-processing-order.php — шаблон электронного письма уведомления содержит детали заказа и отправляется клиенту после оплаты в текстовом формате, класс WC_Email_Customer_Processing_Order
emails\plain\customer-reset-password.php — шаблон электронного письма «сброса пароля» отправляется, когда пользователи сбрасывают свои пароли, класс WC_Email_Customer_Reset_Password
emails\plain\email-addresses.php — шаблон для формирования электронного адреса в текстовом формате, WC_Emails::email_addresses
emails\plain\email-order-items.php — шаблон для формирования элементов заказа (SKU, Заголовок, Стоимость и т.д.) в текстовом формате, WC_Abstract_Order::email_order_items_table
emails\admin-cancelled-order.php — шаблон для html-формата, см. emails\plain\admin-cancelled-order.php
emails\admin-new-order.php — шаблон для html-формата, см. emails\plain\admin-new-order.php
emails\customer-completed-order.php — шаблон для html-формата, см. emails\plain\customer-completed-order.php
emails\customer-invoice.php — шаблон для html-формата, см. emails\plain\customer-invoice.php
emails\customer-new-account.php — шаблон для html-формата, см. emails\plain\customer-new-account.php
emails\customer-note.php — шаблон для html-формата, см. emails\plain\customer-note.php
emails\customer-processing-order.php — шаблон для html-формата, см. emails\plain\customer-processing-order.php
emails\customer-reset-password.php — шаблон для html-формата, см. emails\plain\customer-reset-password.php
emails\email-addresses.php — шаблон для html-формата, см. emails\plain\email-addresses.php
emails\email-footer.php — шаблон для «подвала» электронного письма
emails\email-header.php — шаблон для «шапки» электронного письма
emails\email-order-items.php — шаблон для html-формата, см. emails\plain\email-order-items.php
emails\email-styles.php — шаблон для стилевого оформления электронного письма
Шаблоны общего назначения
 global\wrapper-start.php — шаблон начала врапера страницы, woocommerce_output_content_wrapper()
 global\breadcrumb.php — шаблон вывода «хлебных крошек», woocommerce_breadcrumb()
global\form-login.php — шаблон формы логина, woocommerce_login_form()
global\quantity-input.php — шаблон поля количества для добавления в корзину, woocommerce_quantity_input()
global\sidebar.php — шаблон вывода сайдбара, woocommerce_get_sidebar()
global\wrapper-end.php — шаблон окончания врапера страницы, woocommerce_output_content_wrapper_end()
Шаблоны при выводе в циклах
loop\add-to-cart.php — шаблон добавления в корзину для цикла товаров, woocommerce_template_loop_add_to_cart()
loop\loop-end.php — шаблон окончания цикла вывода товаров, woocommerce_product_loop_end()
loop\loop-start.php — шаблон начала цикла вывода товаров, woocommerce_product_loop_start()
loop\no-products-found.php — шаблон вывода информации о не найденных товарах, woocommerce_content()
loop\orderby.php — шаблон вывода списка сортировок в цикле, woocommerce_catalog_ordering()
loop\pagination.php — шаблон пагинации в цикле, woocommerce_pagination()
loop\price.php — шаблон цены товара в цикле товаров, woocommerce_template_loop_price()
loop\rating.php — шаблон вывода суммарного рейтинга в цикле товаров, woocommerce_template_loop_rating()
loop\result-count.php — шаблон вывода найденного количество в цикле в виде «Показано 5 из 10», woocommerce_result_count()
loop\sale-flash.php — шаблон продаж в цикле товаров, woocommerce_show_product_loop_sale_flash()
Шаблоны для работы с личным кабинетом
myaccount\form-add-payment-method.php — шаблон добавления метода оплаты
myaccount\form-edit-account.php — шаблон формы редактирования своего аккаунта
myaccount\form-edit-address.php — шаблон формы редактирования адреса
myaccount\form-login.php — шаблон формы входа в личный кабинет
myaccount\form-lost-password.php — шаблон формы отправки пароля на электронную почту
myaccount\my-account.php — шаблон вывода личного кабинета
myaccount\my-address.php — шаблон вывода адреса
myaccount\my-downloads.php — шаблон вывода загружаемых товаров
myaccount\my-orders.php — шаблон вывода заказов
myaccount\view-order.php — шаблон просмотра заказа
Шаблоны сообщений пользователю
notices\error.php — шаблон вывода сообщений об ошибках
notices\notice.php — шаблон вывода предупреждений
notices\success.php — шаблон вывода сообщений об успешных действиях
Шаблоны для работы с заказами
order\form-tracking.php — шаблон вывода отслеживания заказа, шорткод [woocommerce_order_tracking]
order\order-again.php — шаблон кнопки «Повторить заказ», woocommerce_order_again_button()
order\order-details.php — шаблон таблицы заказа, woocommerce_order_details_table()
order\tracking.php — шаблон вывода отслеживания заказа, шорткод [woocommerce_order_tracking]
Шаблоны для работы с карточкой товара
\single-product\add-to-cart\external.php — шаблон вывода области добавления в корзину для внешнего товара , woocommerce_external_add_to_cart()
\single-product\add-to-cart\grouped.php — шаблон вывода области добавления в корзину для группового товара , woocommerce_grouped_add_to_cart()
\single-product\add-to-cart\simple.php — шаблон вывода области добавления в корзину для простого товара, woocommerce_simple_add_to_cart()
\single-product\add-to-cart\variable.php — шаблон вывода области добавления в корзину для вариативного товара , woocommerce_variable_add_to_cart()
\single-product\tabs\additional-information.php — шаблон вывода содержимого вкладки «Информация», woocommerce_product_additional_information_tab()
\single-product\tabs\description.php — шаблон вывода содержимого вкладки «Описание», woocommerce_product_description_tab()
\single-product\tabs\tabs.php — шаблон вывода вкладок в карточке товара, woocommerce_output_product_data_tabs()
\single-product\meta.php — шаблон вывода артикула, категорий, меток товара в карточке товара, woocommerce_template_single_meta()
\single-product\price.php — шаблон вывода цены в карточке товара, woocommerce_template_single_price()
\single-product\product-attributes.php — шаблон вывода атрибутов товара, WC_Product::list_attributes()
\single-product\product-image.php — шаблон основной картинки в карточке товара, woocommerce_show_product_images()
\single-product\product-thumbnails.php — шаблон миниатюр в карточке товаров, woocommerce_show_product_thumbnails()
\single-product\rating.php — шаблон вывода рейтинга товара в карточке товара, woocommerce_template_single_rating()
\single-product\related.php — шаблон вывода сопутствующих товаров, woocommerce_related_products()
\single-product\review.php — шаблон вывода комментариев, woocommerce_comments()
\single-product\sale-flash.php — шаблон вывода метки «Распродажа» в карточке товара, woocommerce_show_product_sale_flash()
\single-product\share.php — шаблон вывода продукта обмена в карточке товара, woocommerce_template_single_sharing()
\single-product\short-description.php — шаблон вывода краткого описания в карточке товара, woocommerce_template_single_excerpt()
\single-product\title.php — шаблон вывода заголовка товара в карточке товара, woocommerce_template_single_title()
\single-product\up-sells.php — шаблон вывода рекомендованных товаров, woocommerce_upsell_display()
