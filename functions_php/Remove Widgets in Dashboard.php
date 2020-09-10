<?php // don't include this in your functions.php


function disable_default_dashboard_widgets() {
	
	remove_meta_box('expense_tracking','dashboard','normal');
	
	remove_meta_box('expense_tracker','dashboard','normal');
	
	remove_meta_box('unbilled_expense_tracking','dashboard','normal');
	
	remove_meta_box('invoice_dashboard','dashboard','normal');
	
	remove_meta_box('estimates_dashboard','dashboard','normal');
	
	remove_meta_box('invoice_dashboard','dashboard','normal');
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);