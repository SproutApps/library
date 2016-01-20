<?php // don't include this in your functions.php

function maybe_change_invoice_id( $master_invoice_id = 0, $invoice_id = 0 ) {
	if ( ! class_exists( 'SI_Invoices_Recurring' ) ) {
		return;
	}
	// new invoice created
	$invoice = SI_Invoice::get_instance( $invoice_id );
	$invoice->set_invoice_id( $invoice_id );
}
add_action( 'si_recurring_invoice_created', 'maybe_change_invoice_id', 10, 2 );
