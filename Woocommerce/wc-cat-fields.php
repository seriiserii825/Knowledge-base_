<?php
add_action( 'product_cat_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1 );
add_action( 'product_cat_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1 );
//Product Cat Create page
function wh_taxonomy_add_new_meta_field() {
	?>
    <div class="form-field">
        <label for="wh_meta_title"><?php _e( 'Subtitle', 'wh' ); ?></label>
        <input type="text" name="wh_meta_title" id="wh_meta_title">
        <p class="description"><?php _e( 'Enter a subtitle, <= 60 character', 'wh' ); ?></p>
    </div>
    <!--<div class="form-field">-->
    <!--    <label for="wh_meta_desc">--><?php //_e( 'Meta Description', 'wh' ); ?><!--</label>-->
    <!--    <textarea name="wh_meta_desc" id="wh_meta_desc"></textarea>-->
    <!--    <p class="description">--><?php //_e( 'Enter a meta description, <= 160 character', 'wh' ); ?><!--</p>-->
    <!--</div>-->
	<?php
}
//Product Cat Edit page
function wh_taxonomy_edit_meta_field( $term ) {
	//getting term ID
	$term_id = $term->term_id;
	// retrieve the existing value(s) for this meta field.
	$wh_meta_title = get_term_meta( $term_id, 'wh_meta_title', true );
	$wh_meta_desc  = get_term_meta( $term_id, 'wh_meta_desc', true );
	?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="wh_meta_title"><?php _e( 'Subtitle', 'wh' ); ?></label>
        </th>
        <td>
            <input type="text" name="wh_meta_title" id="wh_meta_title"
                   value="<?php echo esc_attr( $wh_meta_title ) ? esc_attr( $wh_meta_title ) : ''; ?>">
            <p class="description"><?php _e( 'Enter a subtitle, <= 60 character', 'wh' ); ?></p>
        </td>
    </tr>
    <!--<tr class="form-field">-->
    <!--    <th scope="row" valign="top">-->
    <!--        <label for="wh_meta_desc">--><?php //_e( 'Meta Description', 'wh' ); ?><!--</label>-->
    <!--    </th>-->
    <!--    <td>-->
    <!--        <textarea name="wh_meta_desc"-->
    <!--                  id="wh_meta_desc">--><?php //echo esc_attr( $wh_meta_desc ) ? esc_attr( $wh_meta_desc ) : ''; ?><!--</textarea>-->
    <!--        <p class="description">--><?php //_e( 'Enter a meta description', 'wh' ); ?><!--</p>-->
    <!--    </td>-->
    <!--</tr>-->
	<?php
}
add_action( 'edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1 );
add_action( 'create_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1 );
// Save extra taxonomy fields callback function.
function wh_save_taxonomy_custom_meta( $term_id ) {
	$wh_meta_title = filter_input( INPUT_POST, 'wh_meta_title' );
//	$wh_meta_desc  = filter_input( INPUT_POST, 'wh_meta_desc' );
	update_term_meta( $term_id, 'wh_meta_title', $wh_meta_title );
//	update_term_meta( $term_id, 'wh_meta_desc', $wh_meta_desc );
}

#How to retrive custom fields values which we have just created ?
<?php
$productCatMetaTitle = get_term_meta($term_id, 'wh_meta_title', true);
$productCatMetaDesc = get_term_meta($term_id, 'wh_meta_desc', true);

#How to show custom fields values in Product Category Admin Screen listing?
<?php

//Displaying Additional Columns
add_filter( 'manage_edit-product_cat_columns', 'wh_customFieldsListTitle' ); //Register Function
add_action( 'manage_product_cat_custom_column', 'wh_customFieldsListDisplay' , 10, 3); //Populating the Columns

/**
 * Meta Title and Description column added to category admin screen.
 *
 * @param mixed $columns
 * @return array
 */
function wh_customFieldsListTitle( $columns ) {
    $columns['pro_meta_title'] = __( 'Meta Title', 'woocommerce' );
    $columns['pro_meta_desc'] = __( 'Meta Description', 'woocommerce' );
    return $columns;
}

/**
 * Meta Title and Description column value added to product category admin screen.
 *
 * @param string $columns
 * @param string $column
 * @param int $id term ID
 *
 * @return string
 */
function wh_customFieldsListDisplay( $columns, $column, $id ) {
    if ( 'pro_meta_title' == $column ) {
        $columns = esc_html( get_term_meta($id, 'wh_meta_title', true) );
    }
    elseif ( 'pro_meta_desc' == $column ) {
        $columns = esc_html( get_term_meta($id, 'wh_meta_desc', true) );
    }
    return $columns;
}
