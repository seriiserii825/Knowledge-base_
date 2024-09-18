<?php 
// Add Color Select to Product Page
add_action('woocommerce_before_single_variation', 'custom_color_select_field');

function custom_color_select_field() {
    global $product;

    if ( $product->is_type( 'variable' ) ) {
        // Get the 'color' attribute
        $attributes = $product->get_attributes();
        
        if ( isset( $attributes['pa_colori'] ) ) { // Assuming 'pa_colori' is the slug of your attribute
            $terms = wc_get_product_terms( $product->get_id(), 'pa_colori', array( 'fields' => 'all' ) );
            if ( ! empty( $terms ) ) {
                echo '<div class="custom-color-select"><label for="custom_color">Choose Color:</label>';
                echo '<select name="custom_color" id="custom_color">';
                echo '<option value="">Choose an option</option>';
                foreach ( $terms as $term ) {
                    echo '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
                }
                echo '</select></div>';
            }
        }
    }
}


// Save custom color to cart
add_filter('woocommerce_add_cart_item_data', 'add_custom_color_to_cart_item', 10, 2);

function add_custom_color_to_cart_item( $cart_item_data, $product_id ) {
    if( isset( $_POST['custom_color'] ) ) {
        $cart_item_data['custom_color'] = sanitize_text_field( $_POST['custom_color'] );
    }
    return $cart_item_data;
}


// Display custom color in cart
add_filter( 'woocommerce_get_item_data', 'display_custom_color_in_cart', 10, 2 );

function display_custom_color_in_cart( $item_data, $cart_item ) {
    if( isset( $cart_item['custom_color'] ) ) {
        $item_data[] = array(
            'name'  => 'Color',
            'value' => wc_clean( $cart_item['custom_color'] )
        );
    }
    return $item_data;
}

// Save custom color to order
add_action( 'woocommerce_add_order_item_meta', 'save_custom_color_to_order', 10, 2 );

function save_custom_color_to_order( $item_id, $values ) {
    if ( isset( $values['custom_color'] ) ) {
        wc_add_order_item_meta( $item_id, 'Color', $values['custom_color'], true );
    }
}

// Display custom color in minicart
add_filter( 'woocommerce_widget_cart_item_quantity', 'display_custom_color_in_minicart', 10, 3 );

function display_custom_color_in_minicart( $html, $cart_item, $cart_item_key ) {
    if( isset( $cart_item['custom_color'] ) ) {
        $color = wc_clean( $cart_item['custom_color'] );
        $html .= '<p class="custom-color">Color: ' . esc_html( $color ) . '</p>';
    }
    return $html;
}

// Validate custom color field on server-side
add_filter('woocommerce_add_to_cart_validation', 'validate_custom_color_field', 10, 3);

function validate_custom_color_field($passed, $product_id, $quantity) {
    if (isset($_POST['custom_color']) && empty($_POST['custom_color'])) {
        wc_add_notice(__('Seleziona un colore.', 'woocommerce'), 'error');
        return false;
    }
    return $passed;
}
