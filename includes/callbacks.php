<?php
/**
 * Callbacks for Plugin Updater Sample.
 *
 * @since 0.2.0
 * @package Plugin_Updater_Sample
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'update_plugins_plugin-updater-sample', 'plugin_updater_sample_plugin_update', 10, 4 );
/**
 * Callback for WordPress 'update_plugins_{$hostname}' filter.
 *
 * @link https://developer.wordpress.org/reference/hooks/update_plugins_hostname/
 *
 * @since 0.1.0
 *
 * @param boolean|stdClass $update      The update object or default boolean.
 * @param array            $plugin_data The plugin data.
 * @param string           $plugin_file The plugin file path.
 * @param array            $locales     Array of locales.
 *
 * @return boolean|stdClass The update object or default boolean.
 */
function plugin_updater_sample_plugin_update( $update, $plugin_data, $plugin_file, $locales ) {
	if ( 'plugin-updater-sample/plugin-updater-sample.php' !== $plugin_file ) {
		return $update;
	}

	$response = plugin_updater_sample_get_latest_release();
	if ( is_wp_error( $response ) || empty( $response['zipball_url'] ) ) {
		return $update;
	}

	return plugin_updater_sample_get_update_object( $response, $plugin_data, $plugin_file );
}
