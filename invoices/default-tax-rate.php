<?php // don't add this line, since it's already in your functions.php file


function _si_information_meta_box_args( $args ) {
	if ( $args['post']->post_status == 'auto-draft' ) { // only adjust drafts
		$args['tax'] =  15;
	}
	return $args;
}
add_filter( 'load_view_args_admin/meta-boxes/invoices/information.php', '_si_information_meta_box_args' );