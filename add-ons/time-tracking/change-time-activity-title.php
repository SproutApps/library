<?php // don't include this in your functions.php

function change_si_get_time_title( $title = '', SI_Time $time ) {
	return get_the_title( $time->get_id() );
}
add_filter( 'si_get_time_title', 'change_si_get_time_title', 10, 2 );