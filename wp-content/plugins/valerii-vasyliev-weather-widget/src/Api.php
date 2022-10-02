<?php
/**
 * API class file.
 *
 * @package valerii-vasyliev-weather-widget
 */

namespace WeatherWidget;

/**
 * Class Api
 */
class Api {

	/**
	 * Endpoint remote.
	 */
	private const END_POINT_REMOTE = 'https://api.openweathermap.org/data/2.5/weather';

	/**
	 * Cache key.
	 */
	private const CACHE_KEY = 'valerii-vasyliev-weather-widget';

	/**
	 * Cache time expire.
	 */
	private const CACHE_TIME_EXPIRE = 2700; // 45minutes

	/**
	 * API key
	 *
	 * @var string
	 */
	private $api_key;

	/**
	 * Default city
	 *
	 * @var string
	 */
	private $default_city;

	/**
	 * Main constructor.
	 */
	public function __construct() {

		$options            = get_option( 'valerii_vasyliev_weather_widget_name_options' );
		$this->default_city = $options['default_city'] ?? '';
		$this->api_key      = $options['apikey'] ?? '';

	}

	/**
	 * Get weather data from remote server.
	 *
	 * @throws \JsonException JsonException.
	 */
	public function get_weather() {

		$cache_key = self::CACHE_KEY . '_' . $this->default_city;
		$result    = get_transient( $cache_key );

		if ( ! $result ) {

			try {
				$response = wp_remote_get( self::END_POINT_REMOTE . '?q=' . $this->default_city . '&appid=' . $this->api_key );
				if ( ( ! is_wp_error( $response ) ) && ( 200 === wp_remote_retrieve_response_code( $response ) ) ) {
					$result = json_decode( $response['body'], true, 512, JSON_THROW_ON_ERROR );
					if ( json_last_error() === JSON_ERROR_NONE ) {
						set_transient( $cache_key, $result, self::CACHE_TIME_EXPIRE );
					}
				} else {
					return false;
				}
			// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
			} catch ( \Exception $ex ) {
				// Handle Exception.
			}
		}

		return $result;
	}
}
