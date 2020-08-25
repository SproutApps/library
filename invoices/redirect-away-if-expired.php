<?php // don't add this line since it's already in your functions.php file

function si_redirect_if_expired() {
	if ( current_user_can( 'edit_sprout_invoices' ) ) {
		return;
	}

	$expiration = ( 'invoice' === si_get_doc_context() ) ? si_get_invoice_due_date() : si_get_estimate_expiration_date();

	if ( ! $expiration ) {
		return;
	}

	if ( $expiration < current_time( 'timestamp' ) ) {
		$redirect_url = home_url();
		wp_redirect( $redirect_url );
		exit();
	}
}
add_action( 'pre_si_invoice_view', 'si_redirect_if_expired' );
add_action( 'pre_si_estimate_view', 'si_redirect_if_expired' );