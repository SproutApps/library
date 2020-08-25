<?php // don't include this in your functions.php

function maybe_change_invoice_id( $master_invoice_id = 0, $invoice_id = 0 ) {
	if ( ! class_exists( 'SI_Invoices_Recurring' ) ) {
		return;
	}
	// master invoice
	$master_invoice = SI_Invoice::get_instance( $master_invoice_id );
	$master_invoice_id = $master_invoice->get_invoice_id();

	// build id
	$clones = SI_Invoices_Recurring::get_child_clones( $master_invoice_id );
	$new_id = $master_invoice_id . '-' . count( $clones );

	// new invoice created
	$invoice = SI_Invoice::get_instance( $invoice_id );
	$invoice->set_invoice_id( $new_id );
}
add_action( 'si_recurring_invoice_created', 'maybe_change_invoice_id', 10, 2 );
