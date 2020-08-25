<?php // don't include this in your functions.php

function _ask_to_auto_bill_on_checkout() {
	$selection = array();
	$selection['allow_to_autobill'] = array(
		'type' => 'checkbox',
		'weight' => 10,
		'label' => 'Please save my credit card details...',
		'default' => false,
	);
	sa_form_fields( $selection, 'billing' );
}
add_action( 'si_credit_card_payment_controls', '_ask_to_auto_bill_on_checkout' );
remove_action( 'si_credit_card_payment_controls', array( 'SI_Auto_Billing_Checkout', 'ask_to_auto_bill_on_checkout' ) );