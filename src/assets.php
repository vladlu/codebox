<?php

// Exits if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


final class CodeBox_Menu_Assets {



	/**
	 * Suffix for assets.
	 * Either empty string or ".min"
	 *
	 * @var string
	 */
	public $assets_suffix;



	public static function init() {
		$class = __CLASS__;
		new $class;
	}


	public function __construct() {
		$this->assets_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		$this->styles();
		$this->scripts();
		$this->data_to_scripts();
		$this->libraries();
	}


	private function styles() {
		wp_enqueue_style( 'codebox-admin-style', CODEBOX_URL . 'admin/styles/style' . $this->assets_suffix . '.css', [], CODEBOX_VERSION );
	}


	private function scripts() {
		wp_enqueue_script( 'codebox-admin-script', CODEBOX_URL . 'admin/scripts/script' . $this->assets_suffix . '.js', [ 'jquery' ], CODEBOX_VERSION );
	}


	private function data_to_scripts() {
		wp_localize_script( 'codebox-admin-script', 'codebox', [
			'token' => wp_create_nonce( 'codebox-execute' ),
		] );
	}


	private function libraries() {
		$this->babel_polyfill();
		$this->codemirror();
	}


	private function babel_polyfill() {

		wp_enqueue_script(
			'codebox-script-babel-polyfill',
			CODEBOX_URL . 'libs/babel-polyfill/babel-polyfill.js',
			[],
			CODEBOX_VERSION
		);

	}


	private function codemirror() {

		wp_enqueue_style(
			'codebox-codemirror',
			CODEBOX_URL . 'libs/codemirror/codemirror.css',
			[],
			CODEBOX_VERSION
		);


		wp_enqueue_script(
			'codebox-codemirror-main',
			CODEBOX_URL . 'libs/codemirror/codemirror.js',
			[],
			CODEBOX_VERSION
		);


		wp_enqueue_script(
			'codebox-codemirror-htmlmixed',
			CODEBOX_URL . 'libs/codemirror/htmlmixed.js',
			[],
			CODEBOX_VERSION
		);

		wp_enqueue_script(
			'codebox-codemirror-xml',
			CODEBOX_URL . 'libs/codemirror/xml.js',
			[],
			CODEBOX_VERSION
		);

		wp_enqueue_script(
			'codebox-codemirror-javascript',
			CODEBOX_URL . 'libs/codemirror/javascript.js',
			[],
			CODEBOX_VERSION
		);

		wp_enqueue_script(
			'codebox-codemirror-css',
			CODEBOX_URL . 'libs/codemirror/css.js',
			[],
			CODEBOX_VERSION
		);

		wp_enqueue_script(
			'codebox-codemirror-clike',
			CODEBOX_URL . 'libs/codemirror/clike.js',
			[],
			CODEBOX_VERSION
		);

		wp_enqueue_script(
			'codebox-codemirror-php',
			CODEBOX_URL . 'libs/codemirror/php.js',
			[],
			CODEBOX_VERSION
		);

		wp_enqueue_script(
			'codebox-codemirror-addon-edit-matchbrackets',
			CODEBOX_URL . 'libs/codemirror/addon/edit/matchbrackets.js',
			[],
			CODEBOX_VERSION
		);
	}

}
