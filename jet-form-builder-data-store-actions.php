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

	define( 'JFB_CLEAR_DATA_STORE_VERSION', '1.0.0' );

	define( 'JFB_CLEAR_DATA_STORE__FILE__', __FILE__ );
	define( 'JFB_CLEAR_DATA_STORE_PLUGIN_BASE', plugin_basename( __FILE__ ) );
	define( 'JFB_CLEAR_DATA_STORE_PATH', plugin_dir_path( __FILE__ ) );
	define( 'JFB_CLEAR_DATA_STORE_URL', plugins_url( '/', __FILE__ ) );

	require JFB_CLEAR_DATA_STORE_PATH . 'includes/plugin.php';
	
}, 100 );

