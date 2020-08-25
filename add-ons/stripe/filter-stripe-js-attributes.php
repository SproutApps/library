<?php // don't include this in your functions.php

function _remove_auto_email_adjust_logo( $attributes = array(), $invoice_id = 0 ) {
	/**
	 * Data attributes can be found in this documentation 
	 * https://stripe.com/docs/checkout
	 */
	unset( $attributes['email'] );
	$attributes['image'] = '/img/documentation/checkout/marketplace.png';
	return $attributes;
}
add_filter( 'si_stripe_js_data_attributes', '_remove_auto_email_adjust_logo' );
