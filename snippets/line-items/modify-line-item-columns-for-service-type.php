<?php // don't include this in your functions.php

function _add_qty_to_service( $columns, $type ) {
	if ( 'service' !== $type ) {
		$columns['qty']['type'] = 'small-input';
	}
	return $columns;
}
add_filter( 'si_line_item_columns', '_add_qty_to_service', 10, 2 );