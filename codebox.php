<?php
/*
Plugin Name: CodeBox
Description: A PHP Sandbox with WordPress functionality. For developers — for testing purposes.
Version:     1.1.0
Plugin URI:  https://github.com/vladlu/codebox
Author:      Vladislav Luzan
Author URI:  https://vlad.lu/
Text Domain: codebox
License:     MIT
*/


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Main CodeBox class.
 *
 * @since 1.1.0
 */
final class CodeBox {


	/**
	 * Constructor.
	 *
	 * @since 1.1.0
	 */
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


	/**
	 * Defines constants.
	 *
	 * @since 1.1.0
	 */
	private function define_constants() {
		/**
		 * The URL to the plugin.
		 *
		 * @since 1.1.0
		 * @var string CODEBOX_URL
		 */
		define( 'CODEBOX_URL', plugin_dir_url( __FILE__ ) );


		/**
		 * The filesystem directory path to the plugin.
		 *
		 * @since 1.1.0
		 * @var string CODEBOX_DIR
		 */
		define( 'CODEBOX_DIR', plugin_dir_path( __FILE__ ) );


		/**
		 * The version of the plugin.
		 *
		 * @since 1.1.0
		 * @var string CODEBOX_VERSION
		 */
		define( 'CODEBOX_VERSION', get_file_data( __FILE__, ['Version'] )[0] );
	}


	/**
	 * Imports files.
	 *
	 * @since 1.1.0
	 */
	private function import_files() {
		require_once CODEBOX_DIR . 'src/ajax.php';
		require_once CODEBOX_DIR . 'src/menu.php';
		require_once CODEBOX_DIR . 'src/class-assets.php';
	}
}


add_action( 'init', function () {
	if ( current_user_can( 'list_users' ) ) {
		new CodeBox();
	}
} );
