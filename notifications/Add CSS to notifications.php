<?php  // don't include this line in your functions.php, since it already starts with it.

/**
 * Hook into shortcode_line_item_table hook and add custom CSS.
 * 
 */
function si_add_shortcode_line_item_table() {
	?>
<style type="text/css" media="screen">
	@media only print {
		#wpadminbar {
			display: none;
		}
	}
</style>
	<?php
}
add_action( 'shortcode_line_item_table', 'si_add_shortcode_line_item_table' );
