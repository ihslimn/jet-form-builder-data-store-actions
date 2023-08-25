<?php
/**
 * Plugin Name: JetFormBuilder - Data Store Actions
 * Plugin URI:  https://crocoblock.com/
 * Description:
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-forms-addon-boilerplate-simple
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

add_action( 'plugins_loaded', function () {

	if ( ! function_exists( 'jet_form_builder' ) || ! function_exists( 'jet_engine' ) ) {

		add_action( 'admin_notices', function() {
			$class = 'notice notice-error';
			$message = '<b>WARNING!</b> <b>JetFormBuilder - Data Store Actions</b> plugin requires both <b>JetFormBuilder</b> and <b>JetEngine</b> plugins to be installed and activated.';
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
		} );

		return;

	}

	define( 'JFB_CLEAR_DATA_STORE_VERSION', '1.0.0' );

	define( 'JFB_CLEAR_DATA_STORE__FILE__', __FILE__ );
	define( 'JFB_CLEAR_DATA_STORE_PLUGIN_BASE', plugin_basename( __FILE__ ) );
	define( 'JFB_CLEAR_DATA_STORE_PATH', plugin_dir_path( __FILE__ ) );
	define( 'JFB_CLEAR_DATA_STORE_URL', plugins_url( '/', __FILE__ ) );

	require JFB_CLEAR_DATA_STORE_PATH . 'includes/plugin.php';
	
}, 100 );

