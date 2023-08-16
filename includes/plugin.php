<?php

namespace JFB_Clear_Data_Store_Action;

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Plugin {
	/**
	 * Instance.
	 *
	 * Holds the plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	public $slug = 'jfb-data-store-actions';

	public function __construct() {
		$this->init_components();
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_script' ), 10 );
	}

	private function init_components() {
		require JFB_CLEAR_DATA_STORE_PATH . 'includes/jet-form-builder/actions/clear-data-store.php';
		Jet_Form_Builder\Actions\Clear_Data_Store::register();
	}

	public function enqueue_script() {
		wp_enqueue_script(
			Plugin::instance()->slug . '-frontend',
			Plugin::instance()->plugin_url( 'assets/js/frontend.js' ),
			array( 'jquery' ),
			Plugin::instance()->get_version(),
			false
		);
	}

	public function get_version() {
		return JFB_CLEAR_DATA_STORE_VERSION;
	}

	public function plugin_url( $path ) {
		return JFB_CLEAR_DATA_STORE_URL . $path;
	}

	public function get_template_path( $template ) {
		$path = JFB_CLEAR_DATA_STORE_PATH . 'templates' . DIRECTORY_SEPARATOR;
		return ( $path . $template . '.php' );
	}


	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Plugin::instance();