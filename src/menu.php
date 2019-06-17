<?php
/**
 * Menus
 *
 * Adds new menus.
 *
 * @package CodeBox
 * @since 1.0.0
 */


// Exits if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function codebox_admin_menu() {
	$page = add_menu_page(
		'CodeBox',
		'CodeBox',
		'manage_options',
		'codebox',
		function () {
			require_once CODEBOX_DIR . 'src/templates/codebox.php';
		},
		'dashicons-laptop'
	);


	add_action( 'load-' . $page, [ 'CodeBox_Menu_Assets', 'init' ] );
}
