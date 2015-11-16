<?php // don't add this line since it's already in your functions.php file

/**
 * Changing the line item labels/names and adding a new line item type.
 *
 */
function add_new_line_item_types( $types = array() ) {
	$array_of_new_types = array(
		'task' => si__( 'Labour' ), // change label for tasks
		'product' => si__( 'Equipment' ), // change labal for product
		'expenses' => si__( 'Expenses' ), // add new type
		);

	$types = array_merge( $types, $array_of_new_types );
	return $types;
}
add_filter( 'si_line_item_types',  'add_new_line_item_types' );

/**
 * Example of changing the line item type options.
 *
 */
function modify_type_options( $columns = array(), $type = 'expenses' )  {
	if ( 'expenses' === $type ) {
		// modify the columns array for the expenses type
	}
	if ( 'task' === $type ) {
		$columns['desc']['label'] = __( 'Labour', 'sprout-invoices' );
	}
	return $columns;
}
add_filter( 'si_line_item_columns', 'modify_type_options', 10, 2 );