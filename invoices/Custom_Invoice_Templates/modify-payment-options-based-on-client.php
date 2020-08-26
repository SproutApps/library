<?php // don't include this in your functions.php

function _modify_processors_based_on_client( $enabled_processors = array() ) {
	$invoice_id = get_the_id(); // the global page id
	if ( SI_Invoice::POST_TYPE !== get_post_type( $invoice_id ) ) {
		// since the page being shown is not an invoice than we shouldn't filter.
		return $enabled_processors;
	}

	$client = si_get_invoice_client(); // client object
	if ( ! is_a( $client, 'SI_Client' ) ) {
		// not a client object so return.
		return $enabled_processors;
	}
	// logic to decide what the $client should have access to for payment
	// processing

	unset( $enabled_processors['paypal'] ); // example

	return $enabled_processors;
}
add_filter( 'si_payment_options', '_modify_processors_based_on_client' );