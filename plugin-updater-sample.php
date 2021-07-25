<?php
/**
 * Plugin Name: Plugin Updater Sample
 * Plugin URI: https://github.com/basecardhero/plugin-updater-sample
 * Update URI: plugin-updater-sample
 * Description: A sample WordPress plugin to test self-hosted updates.
 * Author: BaseCardHero
 * Author URI: https://basecardhero.com/
 * Version: 0.1.0
 * Requires WP: 5.8
 * Requires PHP: 7.3
 * Text Domain: plugin-updater-sample
 * Domain Path: /languages
 *
 * @package Plugin_Updater_Sample
 */

define( 'PLUGIN_UPDATER_SAMPLE_VER', '0.1.0' );
define( 'PLUGIN_UPDATER_SAMPLE_FILE', __FILE__ );
define( 'PLUGIN_UPDATER_SAMPLE_DIR', dirname( __FILE__ ) );

require_once( PLUGIN_UPDATER_SAMPLE_DIR . '/includes/functions.php' );

add_filter( 'update_plugins_plugin-updater-sample', 'plugin_updater_sample_plugin_update', 10, 4 );
/**
 * Callback for WordPress 'update_plugins_{$hostname}' filter.
 *
 * @since 0.1.0
 *
 * @param boolean|stdClass $update 		The update object or default boolean.
 * @param array 		   $plugin_data The plugin data.
 * @param string 		   $plugin_file The plugin file path.
 * @param array 		   $locales     Array of locales.
 *
 * @return boolean|stdClass The update object or default boolean.
 */
function plugin_updater_sample_plugin_update( $update, $plugin_data, $plugin_file, $locales ) {
	return $update;
}
