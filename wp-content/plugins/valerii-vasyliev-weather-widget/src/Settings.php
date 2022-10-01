<?php
/**
 * Settings class file.
 *
 * @package valerii-vasyliev-weather-widget
 */

namespace WeatherWidget;

/**
 * Class Settings
 */
class Settings {

	/**
	 * Init class.
	 */
	public function init() : void {

		$this->hooks();
	}

	/**
	 * Init hooks
	 */
	protected function hooks(): void {
		add_action( 'admin_init', [ $this, 'options_fields' ] );
	}

	/**
	 * Init options
	 */
	public function options_fields(): void {
		register_setting( 'general', 'valerii_vasyliev_weather_widget_name_options' );
		add_settings_section( 'valerii_vasyliev_weather_widget_name_section', __( 'WordPress Weather Dashboard Widget ', 'valerii-vasyliev-weather-widget' ), false, 'general' );
		add_settings_field( 'valerii_vasyliev_weather_widget_name_apikey', __( 'API Key for openweathermap.org', 'valerii-vasyliev-weather-widget' ), [ $this, 'api_key_func' ], 'general', 'valerii_vasyliev_weather_widget_name_section' );
		add_settings_field( 'valerii_vasyliev_weather_widget_name_default_city', __( 'Default city', 'valerii-vasyliev-weather-widget' ), [ $this, 'default_city_func' ], 'general', 'valerii_vasyliev_weather_widget_name_section' );
	}

	/**
	 * Setting for api key
	 */
	public function api_key_func(): void {
		$options = get_option( 'valerii_vasyliev_weather_widget_name_options' );
		$apikey  = $options['apikey'] ?? '';
		echo "<input id='valerii_vasyliev_weather_widget_name_apikey' name='valerii_vasyliev_weather_widget_name_options[apikey]' size='110' type='text' value='" . esc_attr( $apikey ) . "' />";
	}

	/**
	 * Setting for default city
	 */
	public function default_city_func(): void {
		$options      = get_option( 'valerii_vasyliev_weather_widget_name_options' );
		$default_city = $options['default_city'] ?? '';
		echo "<input id='valerii_vasyliev_weather_widget_name_apikey' name='valerii_vasyliev_weather_widget_name_options[default_city]' size='110' type='text' value='" . esc_attr( $default_city ) . "' />";
	}
}
