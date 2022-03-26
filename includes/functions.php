<?php
/**
 * General functions for Plugin Updater Sample.
 *
 * @since 0.1.0
 * @package Plugin_Updater_Sample
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the plugin update data as an object.
 *
 * @since 0.2.0
 *
 * @param array  $response    The remote response data as an associative array.
 * @param array  $plugin_data The plugin data as an associative array.
 * @param string $plugin_file The relative plugin file.
 *
 * @return stdClass The plugin update object.
 */
function plugin_updater_sample_get_update_object( array $response, array $plugin_data, string $plugin_file ) {
	$update               = new stdClass();
	$update->slug         = dirname( $plugin_file );
	$update->url          = $plugin_data['PluginURI'];
	$update->tested       = $plugin_data['RequiresWP'];
	$update->requires_php = $plugin_data['RequiresPHP'];
	$update->version      = str_replace( 'v', '', $response['tag_name'] );
	$update->package      = $response['zipball_url'];

	return $update;
}

/**
 * Retrieve the latest plugin release object.
 *
 * @uses wp_remote_get()
 * @link https://developer.wordpress.org/reference/functions/wp_remote_get/
 *
 * @since 0.1.0
 * @since 0.2.0 Corrected bug when decoding response to json.
 *
 * @return array|WP_Error The response as an array or WP_Error.
 */
function plugin_updater_sample_get_latest_release() {
	$response = wp_remote_get(
		'https://api.github.com/repos/basecardhero/plugin-updater-sample/releases/latest',
		array(
			'headers' => array(
				'Accept' => 'application/vnd.github.v3+json',
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$data = json_decode(
		wp_remote_retrieve_body( $response ),
		true
	);

	if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
		$message = 'An error occurred attempting to retrieve the release.';

		if ( isset( $data['message'] ) ) {
			$message = $data['message'];
		}

		return new WP_Error( 'github_error', $message );
	}

	return $data;
}
