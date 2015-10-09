<?php // don't include this in your functions.php

function maybe_change_invoice_status( $post_id ) {
	if ( SI_Invoice::POST_TYPE !== get_post_type( $post_id ) ) {
		return;
	}
	$invoice = SI_Invoice::get_instance( $post_id );
	if ( SI_Invoice::STATUS_TEMP === $invoice->get_status() ) {
		$invoice->set_pending();
	}
}
add_action( 'save_post', 'maybe_change_invoice_status' );