<?php
// Select field in checkout page
add_filter('woocommerce_billing_fields', 'true_add_custom_office_field', 25);
function true_add_custom_office_field($fields)
{

  // массив нового поля
  $new_field = array(
    'billing_office' => array(
      'type'          => 'select', // text, textarea, select, radio, checkbox, password
      'required'  => true, // по сути только добавляет значок "*" и всё
      'class'         => array('true-field', 'form-row-wide'), // массив классов поля
      'label'         => 'Apt./Oficiu',
      'label_class'   => 'true-label', // класс лейбла
      'options'  => array( // options for  or
        ''    => 'Alegeti', // пустое значение
        'Apartament'  => 'Apartament', // 'значение'=>'заголовок'
        'Oficiu'  => 'Oficiu'
      )
    )
  );

  // объединяем поля
  $fields = array_slice($fields, 0, 2, true) + $new_field + array_slice($fields, 2, NULL, true);

  return $fields;
}

// Validation
add_action('woocommerce_after_checkout_validation', 'office_validate_field', 25, 2);

function office_validate_field($fields, $errors)
{

  // проверка, что пустое
  if ('' === $fields['billing_office']) {
    // удаление стандартной ошибки нужно, если вы решили использовать 2-й метод добавления поля
    $errors->remove('billing_office_required');
    // добавляем кастомную ошибку
    $errors->add('validation', 'Alegeti Apt./Oficiu');
  }
}

// Save field
add_action('woocommerce_checkout_update_order_meta', 'true_save_field_office', 25);

function true_save_field_office($order_id)
{

  if (!empty($_POST['billing_office'])) {
    update_post_meta($order_id, 'billing_office', sanitize_text_field($_POST['billing_office']));
  }
}

// Display field in order
add_action('woocommerce_admin_order_data_after_billing_address', 'office_true_print_field_value', 25);

function office_true_print_field_value($order)
{

  if ($method = get_post_meta($order->get_id(), 'billing_office', true)) {
    echo '<p><strong>App/Office</strong><br>' . esc_html($method) . '</p>';
  }
}
?>


<?php
// bs-styles

wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css');
wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery'), null, true);

?>?>

<script>
	if (document.querySelector('#billing_office')) {
		$('#billing_office').select2({ width: '100%' });
	}

// with ajax
$('#rudr_select2_posts').select2({
  		ajax: {
    			url: ajaxurl, // AJAX URL is predefined in WordPress admin
    			dataType: 'json',
    			delay: 250, // delay in ms while typing when to perform a AJAX search
    			data: function (params) {
      				return {
        				q: params.term, // search query
        				action: 'mishagetposts' // AJAX action for admin-ajax.php
      				};
    			},
    			processResults: function( data ) {
				var options = [];
				if ( data ) {
			
					// data is the array of arrays, and each of them contains ID and the Label of the option
					$.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
						options.push( { id: text[0], text: text[1]  } );
					});
				
				}
				return {
					results: options
				};
			},
			cache: true
		},
		minimumInputLength: 3 // the minimum of symbols to input before perform a search
	});
</script>
