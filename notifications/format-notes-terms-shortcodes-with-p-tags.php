<?php // don't include this line in your functions.php, it already has it.

function _si_add_autop_filter_to_notes_and_terms( $string = '' ) {
	return wpautop( $string );
}
add_filter( 'shortcode_invoice_notes', '_si_add_autop_filter_to_notes_and_terms' );
add_filter( 'shortcode_invoice_terms', '_si_add_autop_filter_to_notes_and_terms' );
add_filter( 'shortcode_estimate_notes', '_si_add_autop_filter_to_notes_and_terms' );
add_filter( 'shortcode_estimate_terms', '_si_add_autop_filter_to_notes_and_terms' );