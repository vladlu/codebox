<?php
/*
Plugin Name: CodeBox
Description: A PHP Sandbox with WordPress functionality. For developers — for testing purposes.
Version:     0.8
Plugin URI:  https://github.com/vladlu/codebox
Author:      Vladislav Luzan
Author URI:  https://vlad.lu/
Text Domain: codebox
License:     MIT
*/

// Exits if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


final class CodeBox {

	public function __construct() {
		$this->define_constants();
		$this->import_files();

		// Menu
		add_action( 'admin_menu', 'codebox_admin_menu' );

		// AJAX Handler
		if ( wp_doing_ajax() ) {
			add_action( 'wp_ajax_codebox_execute', 'codebox_ajax_execute' );
		}
	}


	private function define_constants() {
		define( 'CODEBOX_URL', plugin_dir_url( __FILE__ ) );
		define( 'CODEBOX_DIR', plugin_dir_path( __FILE__ ) );
		define( 'CODEBOX_VERSION', '0.8' );
	}


	private function import_files() {
		require_once( CODEBOX_DIR . 'src/ajax.php' );
		require_once( CODEBOX_DIR . 'src/menu.php' );
		require_once( CODEBOX_DIR . 'src/assets.php' );
	}
}


add_action( 'init', function () {
	if ( current_user_can( 'list_users' ) ) {
		new CodeBox;
	}
} );
