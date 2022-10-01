<?php
namespace WeatherWidgetTests;

use WeatherWidget\Plugin;
use WeatherWidget\Api;
use function Brain\Monkey\Functions\expect;
use function Brain\Monkey\Functions\when;

class PluginTest extends TestCase {

	protected $instance;

	/**
	 * Sets the instance.
	 */
	protected function setUp(): void {
		parent::setUp();

		$this->instance = \Mockery::mock( Plugin::class, [Api::class])->makePartial();
	}

	public function test_init(): void {

		expect( '\is_admin' )
			->once()
			->withNoArgs()
			->andReturn( true );

		$mock = \Mockery::mock( Plugin::class, [Api::class])->makePartial()->shouldAllowMockingProtectedMethods();

		$mock->shouldReceive( 'hooks' )->once();

		$mock->init();
	}

	public function test_hooks(): void {

		$this->instance->hooks();

		$this->assertSame( 10, has_action('plugins_loaded', [$this->instance, 'load_plugin_textdomain']));
		$this->assertSame( 10, has_action('wp_dashboard_setup', [$this->instance, 'add_dashboard_widgets']));
		$this->assertSame( 10, has_action('admin_enqueue_scripts', [$this->instance, 'enqueue_weather_style']));
	}


	public function test_enqueue_weather_style() : void {

		expect('\wp_register_style')
			->once()
			->with(
				'weather_widget_style',
				WEATHER_WIDGET_URL . '/assets/css/weather.css',
				[],
				WEATHER_WIDGET_VERSION
			);

		expect('\wp_enqueue_style')
			->once()
			->with('weather_widget_style');

		$this->instance->enqueue_weather_style();
	}

	public function test_add_dashboard_widgets() : void {

		expect( '\esc_html__' )
			->with( \Mockery::type( 'string' ), 'valerii-vasyliev-weather-widget' )
			->atLeast()
			->andReturn( 'translated' );

		when( '\wp_add_dashboard_widget' )->justReturn( true );

		$this->instance->add_dashboard_widgets();
	}

	public function test_weather_dashboard_widget_render(): void {

		$result = [
			"coord" => [
				"lon" => 151.2667,
				"lat" => -33.7667
			],
			"weather" => [
				[
					"id" => 500,
					"main" => "Rain",
					"description" => "light rain",
					"icon" => "10n"
				]
			],
			"base" => "stations",
			"main" => [
				"temp" => 284.55,
				"feels_like" => 284.07,
				"temp_min" => 282.86,
				"temp_max" => 286.11,
				"pressure" => 1020,
				"humidity" => 89
			],
			"visibility" => 10000,
			"wind" => [
				"speed" => 2.24,
				"deg" => 235,
				"gust" => 4.47
			],
			"rain" => [
				"1h" => 0.22
			],
			"clouds" => [
				"all" => 96
			],
			"dt" => 1664635709,
			"sys" => [
				"type" => 2,
				"id" => 2003436,
				"country" => "AU",
				"sunrise" => 1664652678,
				"sunset" => 1664697448
			],
			"timezone" => 36000,
			"id" => 2208303,
			"name" => "Brookvale",
			"cod" => 200
		];

		$dependency = \Mockery::mock(Api::class);

		$dependency->shouldReceive('get_weather')->once()->andReturn($result);

		$this->instance = \Mockery::mock( Plugin::class, [$dependency])->makePartial();

		expect( '__' )->with( \Mockery::type( 'string' ), 'valerii-vasyliev-weather-widget' )->atLeast()->once()->andReturn( 'translated' );

		$this->instance->weather_dashboard_widget_render();
	}

	public function test_load_plugin_textdomain() : void {

		$expectedBaseName = 'valerii-vasyliev-weather-widget';

		expect('\plugin_basename')->andReturn($expectedBaseName);

		expect('\load_plugin_textdomain')
			->once()
			->with('valerii-vasyliev-weather-widget', false, './languages/');

		$this->instance->load_plugin_textdomain();
	}
}
