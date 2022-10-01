<?php
namespace WeatherWidgetTests;

use WeatherWidget\Api;
use function Brain\Monkey\Functions\expect;
use function Brain\Monkey\Functions\when;

class ApiTest extends TestCase {

	protected $instance;

	/**
	 * Sets the instance.
	 */
	protected function setUp(): void {
		parent::setUp();

		$this->instance = \Mockery::mock( Api::class)->makePartial();
	}

	public function test_get_weather_none_cached() {

		when( '\get_transient' )->justReturn( false );

		when('\wp_remote_get')->justReturn(['body' => '{"test":"response"}']);

		expect( '\set_transient' )->once()->andReturn( true );

		$this->instance->get_weather();
	}

	public function test_get_weather_cached() {

		when( '\get_transient' )->justReturn(['test' => 'response']);

		expect( '\wp_remote_get' )->never();

		expect( '\set_transient' )->never();

		$this->instance->get_weather();
	}
}
