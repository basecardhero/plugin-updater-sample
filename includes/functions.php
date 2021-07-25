<?php
/**
 * General functions for Plugin Updater Sample.
 *
 * @since 0.1.0
 * @package Plugin_Updater_Sample
 */

/**
 * Retrieve the latest plugin release object.
 *
 * @uses wp_remote_get()
 *
 * @since 0.1.0
 *
 * @return array|WP_Error The response as an array or WP_Error.
 */
function plugin_updater_sample_get_latest_release() {
	$response = wp_remote_get(
		'https://api.github.com/repos/basecardhero/plugin-updater-sample/releases/latest',
		[
			'headers' => [
				'Accept' => 'application/vnd.github.v3+json',
			]
		]
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$data = json_encode(
		wp_remote_retrieve_body( $response )
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
