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

define('SITE_PATH', realpath(__DIR__ . '/../../../../../../') . '/');
define('PLUGIN_NAME_DEBUG', true);
define('PLUGIN_NAME_PATH', realpath(__DIR__ . '/../../../') . '/');
define('ABSPATH', realpath(PLUGIN_NAME_PATH . '../../') . '/');
define('PLUGIN_NAME_URL', 'https://example.com/wp-content/plugins/valerii-vasyliev-weather-widget/');
define('PHPUNIT_RUNNING', 1);
require_once SITE_PATH . 'vendor/autoload.php';
require_once PLUGIN_NAME_PATH . 'vendor/autoload.php';
