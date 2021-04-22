<?php
// Adds a custom rule type.
add_filter( 'acf/location/rule_types', function ( $choices ) {
	$choices[ __( "Other", 'acf' ) ]['wc_prod_attr'] = 'WC Product Attribute';
	return $choices;
} );
// Adds custom rule values.
add_filter( 'acf/location/rule_values/wc_prod_attr', function ( $choices ) {
	foreach ( wc_get_attribute_taxonomies() as $attr ) {
		$pa_name             = wc_attribute_taxonomy_name( $attr->attribute_name );
		$choices[ $pa_name ] = $attr->attribute_label;
	}
	return $choices;
} );
// Matching the custom rule.
add_filter( 'acf/location/rule_match/wc_prod_attr', function ( $match, $rule, $options ) {
	if ( isset( $options['taxonomy'] ) ) {
		if ( '==' === $rule['operator'] ) {
			$match = $rule['value'] === $options['taxonomy'];
		} elseif ( '!=' === $rule['operator'] ) {
			$match = $rule['value'] !== $options['taxonomy'];
		}
	}
	return $match;
}, 10, 3 );

?>
In the function for matching the rule on the term edit page, the $options['ef_taxonomy'] has been changed to $options['taxonomy'] — back then, the array key taxonomy didn't exist (in my case), and it exists now, which I think replaces the ef_taxonomy key. Thanks @JordanCarter for noticing the key issue, and @VadimH for the initial answer's edit. =)

In that function, I also added the if ( isset( $options['taxonomy'] ) ) check to avoid PHP's "undefined" notice. Thanks @JordanCarter for noticing this.

@VadimH, you can use get_field( '{NAME}', 'term_{TERM ID}' ) to retrieve (and display) the field's value, like so:

$term_id = 123;
$value = get_field( 'my_field', 'term_' . $term_id );
See the "Get a value from different objects" section on the get_field()'s official documentation.

PS: The whole code (not just the get_field()) was last tried and tested on ACF 5.7.6 and ACF PRO 5.7.3, with WooCommerce 3.4.5.
