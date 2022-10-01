<?php
namespace WeatherWidgetTests;

use WeatherWidget\Settings;
use function Brain\Monkey\Functions\expect;
use function Brain\Monkey\Functions\stubs;

class SettingsTest extends TestCase {

	/**
	 * Sets the instance.
	 */
	protected function setUp(): void {
		parent::setUp();

		$this->instance = \Mockery::mock( Settings::class )->makePartial();
	}

	/**
	 * Test init() method
	 */
	public function test_init() : void {

		$mock = \Mockery::mock( Settings::class )->makePartial()->shouldAllowMockingProtectedMethods();

		$mock->shouldReceive( 'hooks' )->once();

		$mock->init();
	}

	/**
	 * Test hooks() method
	 */
	public function test_hooks(): void {
		$this->instance->hooks();

		$this->assertSame( 10, has_action( 'admin_init', [ $this->instance, 'options_fields' ] ) );
	}

	/**
	 * Test options_fields() method
	 */
	public function test_options_fields(): void {

		expect( '__' )->with( \Mockery::type( 'string' ), 'valerii-vasyliev-weather-widget' )->atLeast()->once()->andReturn( 'translated' );

		expect( '\register_setting' )
			->once()
			->with( 'general', 'valerii_vasyliev_weather_widget_name_options' );

		expect( '\add_settings_section' )
			->once()
			->with( 'valerii_vasyliev_weather_widget_name_section', \Mockery::type( 'string' ), false, 'general' );

		expect( '\add_settings_field' )
			->once()
			->with( 'valerii_vasyliev_weather_widget_name_apikey', \Mockery::type( 'string' ), [ $this->instance, 'api_key_func' ], 'general', 'valerii_vasyliev_weather_widget_name_section' );

		expect( '\add_settings_field' )
			->once()
			->with( 'valerii_vasyliev_weather_widget_name_default_city', \Mockery::type( 'string' ), [ $this->instance, 'default_city_func' ], 'general', 'valerii_vasyliev_weather_widget_name_section' );

		$this->instance->options_fields();
	}

	/**
	 * Test api_key_func() method
	 */
	public function test_api_key_func(): void {

		stubs(
			[
				'\esc_attr',
			]
		);

		expect( '\get_option' )
			->once()
			->with( 'valerii_vasyliev_weather_widget_name_options' )
			->andReturn( [ 'apikey' => '123456' ] );

		$this->instance->api_key_func();
	}

	/**
	 * Test default_city_func() method
	 */
	public function test_default_city_func(): void {

		stubs(
			[
				'\esc_attr',
			]
		);

		expect( '\get_option' )
			->once()
			->with( 'valerii_vasyliev_weather_widget_name_options' )
			->andReturn( [ 'default_city' => 'brookvale,australia' ] );

		$this->instance->default_city_func();
	}
}
