<?php // don't include this in your functions.php

function _si_change_default_status_to_pending( SI_Invoice $invoice ) {
	$invoice->set_pending();
}
add_action( 'sa_new_invoice', '_si_change_default_status_to_pending' );