<?php

/**
 * Bootstrap file for unit tests that run before all tests.
 *
 * @since   1.0.0
 * @link    https://valera.codes/
 * @license GPLv2 or later
 * @package
 * @author  Valerii Vasyliev
 */

define( 'PLUGIN_NAME_DEBUG', true );
define( 'PLUGIN_NAME_PATH', realpath( __DIR__ . '/../../../' ) . '/' );
define( 'ABSPATH', realpath( PLUGIN_NAME_PATH . '../../' ) . '/' );
define( 'PLUGIN_NAME_URL', 'https://example.com/wp-content/plugins/valerii-vasyliev-weather-widget/' );
define( 'WEATHER_WIDGET_FILE', PLUGIN_NAME_PATH . 'plugin.php' );
define( 'WEATHER_WIDGET_VERSION', '1.0.0' );
define( 'WEATHER_WIDGET_URL', 'https://example.com/wp-content/plugins/valerii-vasyliev-weather-widget'  );
define( 'PHPUNIT_RUNNING', 1 );
require_once PLUGIN_NAME_PATH . 'vendor/autoload.php';
