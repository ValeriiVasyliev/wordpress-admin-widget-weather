<?php
/**
 * WordPress Weather Dashboard Widget
 *
 * @package           valerii-vasyliev-weather-widget
 * @author            Valerii Vasyliev
 * @license           GPL-2.0-or-later
 * @wordpress-plugin
 *
 * Plugin Name:         WordPress Weather Dashboard Widget
 * Description:         WordPress Weather Dashboard Widget
 * Version:             1.0.0
 * Requires at least:   5.9
 * Requires PHP:        7.4
 * Author:              Valerii Vasyliev
 * Author URI:          https://valera.codes/
 * License:             GPL-2.0-or-later
 * Text Domain:         valerii-vasyliev-weather-widget
 */

namespace WeatherWidget;

if ( ! defined( 'ABSPATH' ) ) {
	// @codeCoverageIgnoreStart
	exit;
	// @codeCoverageIgnoreEnd
}

if ( defined( 'WEATHER_WIDGET_VERSION' ) ) {
	return;
}

/**
 * Plugin version.
 */
define( 'WEATHER_WIDGET_VERSION', '1.0.0' );

/**
 * Path to the plugin dir.
 */
define( 'WEATHER_WIDGET_PATH', __DIR__ );

/**
 * Plugin dir url.
 */
define( 'WEATHER_WIDGET_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Main plugin file.
 */
define( 'WEATHER_WIDGET_FILE', __FILE__ );

/**
 * Init plugin on plugin load.
 */
require_once constant( 'WEATHER_WIDGET_PATH' ) . '/vendor/autoload.php';

( new Plugin( new API() ) )->init();
