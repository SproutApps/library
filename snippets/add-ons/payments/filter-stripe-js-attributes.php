<?php // don't include this in your functions.php

function _remove_auto_email_adjust_logo( $attributes = array(), $invoice_id = 0 ) {
	unset( $attributes['email'] );
	$attributes['image'] = ( get_theme_mod( 'si_logo' ) ) ? esc_url( get_theme_mod( 'si_logo', si_doc_header_logo_url( $invoice_id ) ) ) : si_doc_header_logo_url( $invoice_id );
	return $attributes;
}
add_filter( 'si_stripe_js_data_attributes', '_remove_auto_email_adjust_logo' );