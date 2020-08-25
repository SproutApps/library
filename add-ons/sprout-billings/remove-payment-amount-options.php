<?php // don't include this in your functions.php

remove_action( 'si_credit_card_form_controls', array( 'SI_Auto_Billing_Client_Set_Payment', 'client_set_price_view' ) );