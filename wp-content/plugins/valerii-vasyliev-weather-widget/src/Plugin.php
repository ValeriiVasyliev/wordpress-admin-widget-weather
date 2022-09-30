<?php
/**
 * WeatherWidget class
 *
 * @package valerii-vasyliev-weather-widget
 */

namespace WeatherWidget;

/**
 * Class Plugin
 */
class Plugin {

	/**
	 * API instance.
	 *
	 * @var API
	 */
	private $api;

	/**
	 * Main constructor.
	 *
	 * @param API $api API instance.
	 */
	public function __construct( $api ) {
		$this->api = $api;
	}

	/**
	 * Init class.
	 */
	public function init(): void {
		if ( ! is_admin() ) {
			return;
		}

		( new Settings() )->init();

		$this->hooks();
	}

	/**
	 * Class hooks.
	 *
	 * @return void
	 */
	private function hooks() {
		add_action( 'plugins_loaded', [ $this, 'load_plugin_textdomain' ] );
		add_action( 'wp_dashboard_setup', [ $this, 'add_dashboard_widgets' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_weather_style' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_weather_script' ] );
	}

	/**
	 * Enqueue widget style
	 */
	public function enqueue_weather_style() : void {
		wp_register_style( 'weather_widget_style', WEATHER_WIDGET_URL . '/assets/css/weather.css', [], WEATHER_WIDGET_VERSION );
		wp_enqueue_style( 'weather_widget_style' );
	}


	/**
	 * Enqueue widget javascript
	 */
	public function enqueue_weather_script() : void {

		wp_register_script( 'weather_widget_script', WEATHER_WIDGET_URL . '/assets/js/weather.js', [], WEATHER_WIDGET_VERSION, false );
		wp_enqueue_script( 'weather_widget_script' );
	}

	/**
	 * Add a widget to the dashboard
	 */
	public function add_dashboard_widgets() : void {
		wp_add_dashboard_widget(
			'weather_dashboard_widget',                          // Widget slug.
			esc_html__( 'Weather Dashboard Widget', 'valerii-vasyliev-weather-widget' ), // Title.
			[ $this, 'weather_dashboard_widget_render' ]                    // Display function.
		);
	}

	/**
	 * Create the function to output the content of our Dashboard Widget.
	 */
	public function weather_dashboard_widget_render(): void {

		$data = $this->api->get_weather();

		$today_temp = number_format( $data['main']['temp'], 1 );
		$today_high = number_format( $data['main']['temp_max'], 1 );
		$today_low  = number_format( $data['main']['temp_min'], 1 );

		$data['main']['humidity'] = round( $data['main']['humidity'], 1 );
		$data['wind']['speed']    = round( $data['wind']['speed'], 1 );

		$output  = '<div class="weather-wrap">';
		$output .= '<div class="weather-header">';

		$output .= $data['name'];

		$output .= '<br/>' . $today_temp . ' °' . __( 'F', 'valerii-vasyliev-weather-widget' ) . '</div>';

		$output .= '
				<div class="weather-todays-stats">
					<div class="awe_desc">' . $data['weather'][0]['description'] . '</div>
						<div class="awe_humidty">humidity: ' . $data['main']['humidity'] . '% </div>
						<div class="awe_wind">wind: ' . $data['wind']['speed'] . 'km/h ' . $data['wind']['deg'] . '</div>
						<div class="awe_highlow">H: ' . $today_high . ' °' . __( 'F', 'valerii-vasyliev-weather-widget' ) . ' &bull; L: ' . $today_low . ' °' . __( 'F', 'valerii-vasyliev-weather-widget' ) . '
					</div>
			 </div>';

		$output .= '</div>';

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $output;
	}

	/**
	 * Load plugin text domain.
	 *
	 * @return void
	 */
	public function load_plugin_textdomain() : void {
		global $l10n;

		$domain = 'valerii-vasyliev-weather-widget';

		if ( isset( $l10n[ $domain ] ) ) {
			return;
		}

		load_plugin_textdomain(
			$domain,
			false,
			dirname( plugin_basename( WEATHER_WIDGET_FILE ) ) . '/languages/'
		);
	}

	/**
	 * Exit method.
	 * We need this method to cover methods using 'exit' by phpunit test,
	 * as php 'exit' statement is impossible to mock.
	 */
	protected function php_exit(): void {
		// @codeCoverageIgnoreStart
		exit;
		// @codeCoverageIgnoreEnd
	}
}
