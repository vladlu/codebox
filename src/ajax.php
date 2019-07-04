<?php
/**
 * AJAX handlers
 *
 * @package CodeBox
 * @since 1.0.0
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * AJAX handler that executes arbitrary code.
 *
 * @since 1.1.0
 */
function codebox_ajax_execute() {

	/*
     * Nonce check.
     */
	check_ajax_referer( 'codebox-execute', 'nonceToken' );



	$code = stripcslashes( $_POST['code'] );

	error_reporting( E_ALL );
	ini_set( 'log_errors', 0 );
	ini_set( 'display_errors', 1 );
	ini_set( 'assert.quiet_eval', 0 );

	eval( "?>$code" );



	wp_die();
}
