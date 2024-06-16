#цена простого и вариативного товара
//получаем цену продажи (распродажи)
echo $sale_price = get_post_meta(get_the_ID(), '_price', true);

//получаем обычную стоимость товара (простого товара)
$regular_price = get_post_meta(get_the_ID(), '_regular_price', true);

//если у нас обычная стоимость отсутствует, то будем перебирать вариативную
if ($regular_price == "") {

    //1: получим вариации
	$available_variations = $product->get_available_variations();

    //получим значения цен
    //цена продажи (распродажи) первой вариации
	$v1_display_price = $available_variations[0]['display_price'];
    //обычная цена продажи первой вариации
	$v1_display_regular_price = $available_variations[0]['display_regular_price'];
    //$available_variations можно использовать в цикле, чтобы получить значения всех вариаций
}

//Данные получены, можем веселиться с отображением
//Далее, я думаю, все просто и понятно

#currency
get_woocommerce_currency_symbol()
