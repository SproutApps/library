<?php //remove this line in you're functions php

 /**
 * set the default due date for all created invoices.
 * current example is sixty days. 
 */
function _default_due_in_days() {
	return 60;
}
add_filter( 'si_default_due_in_days', '_default_due_in_days' );

