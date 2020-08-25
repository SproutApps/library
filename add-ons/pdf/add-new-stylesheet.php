<?php // don't include this in your functions.php

/**
 * Remove the default PDF stylesheet
 */
remove_action( 'si_head', array( 'SI_PDF', 'si_add_stylesheet' ), 100 );
/**
 * Add a new pdf stylesheet
 * The stylesheet will need to be added to your theme's directory, i.e. twenty-ten/sa_templates/pdf.css
 */
add_action( 'si_head', '_custom_si_add_stylesheet' );
function _custom_si_add_stylesheet() {
	if ( SI_PDF::want_create_pdf() ) {
		echo "string";
		echo '<link rel="stylesheet" id="si-pdf-css" href="' . get_template_directory_uri() . '/sa_templates/pdf.css" type="text/css" media="all">';
	}
}