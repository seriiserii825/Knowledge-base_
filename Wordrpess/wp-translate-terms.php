<?php

function translate_taxonomy_label( $tax_group, $tax ) {
	if ( get_lang() !== '_it' ) {
		return get_field( $tax_group, 584 )[ $tax . get_lang() ];
	} else {
		return get_taxonomy( $tax )->label;
	}
}
function translate_taxonomy_text( $tax, $field ) {
	if ( get_lang() !== '_it' ) {
		$term = get_the_terms( get_the_ID(), $tax )[0];
		return get_field( $field . get_lang(), $term );
	} else {
		return wp_get_post_terms( get_the_ID(), $tax )[0]->name;
	}
}
