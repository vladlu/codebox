<?php

// Exits if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function codebox_ajax_execute() {
	if ( wp_verify_nonce( $_POST['token'], 'codebox-execute' ) ) {
		$code = stripcslashes( $_POST['code'] );

		ini_set( 'display_errors', 1 );

		eval( "?>$code" );

		wp_die();
	}
}