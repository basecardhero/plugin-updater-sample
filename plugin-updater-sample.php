<?php
/**
 * Plugin Name: Plugin Updater Sample
 * Description: A sample plugin to test self-hosting plugins in WordPress 5.8+.
 * Plugin URI: https://github.com/basecardhero/plugin-updater-sample
 * Update URI: plugin-updater-sample
 * Author: BaseCardHero
 * Author URI: https://basecardhero.com/
 * Version: 0.2.0
 * Requires at least: 5.9
 * Requires PHP: 7.3
 * Text Domain: plugin-updater-sample
 * Domain Path: /languages
 *
 * @package Plugin_Updater_Sample
 */

define( 'PLUGIN_UPDATER_SAMPLE_DIR', dirname( __FILE__ ) );

require_once PLUGIN_UPDATER_SAMPLE_DIR . '/includes/functions.php';
require_once PLUGIN_UPDATER_SAMPLE_DIR . '/includes/callbacks.php';
