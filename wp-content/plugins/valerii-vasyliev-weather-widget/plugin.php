<?php

/**
 * Plugin Name:         WordPress Weather Dashboard Widget
 * Description:         WordPress Weather Dashboard Widget
 * Version:             1.0.0
 * Requires at least:   5.9
 * Requires PHP:        7.4
 * Author:              Valerii Vasyliev
 * Author URI:          https://valera.codes/
 * License:             MIT
 * Text Domain:         valerii-vasyliev-weather-widget
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

use WeatherWidget\Plugin;
use Auryn\Injector;

define('PLUGIN_NAME_DIR', plugin_dir_path(__FILE__));
define('PLUGIN_NAME_URL', plugin_dir_url(__FILE__));

require_once PLUGIN_NAME_DIR . 'vendor/autoload.php';

function activateWeatherWidget(): void
{
}

register_activation_hook(__FILE__, 'activateWeatherWidget');

function deactivateWeatherWidget(): void
{
}

register_deactivation_hook(__FILE__, 'deactivateWeatherWidget');

/**
 * @throws \Auryn\InjectionException
 */
function run_plugin_name()
{
    load_plugin_textdomain('valerii-vasyliev-weather-widget', false, PLUGIN_NAME_DIR . '/languages/');

    $injector = new Injector();

    ( $injector->make(Plugin::class) )->run();

    do_action('plugin_name_init', $injector);
}

add_action('plugins_loaded', 'run_plugin_name');
