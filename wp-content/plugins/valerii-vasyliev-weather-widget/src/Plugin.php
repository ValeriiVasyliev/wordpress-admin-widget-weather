<?php

/**
 * WeatherWidget Bootstrap class
 *
 * @since   1.0.0
 * @link    https://valera.codes/
 * @license GPLv2 or later
 * @package
 * @author  Valerii Vasyliev
 */

namespace WeatherWidget;

use Exception;
use Auryn\Injector;
use Auryn\InjectionException;
use WeatherWidget\Front\Front;
use WeatherWidget\Admin\Settings;

/**
 * Class Plugin
 *
 * @package WeatherWidget
 */
class Plugin
{
    /**
     * Dependency Injection Container.
     *
     * @since 1.0.1
     *
     * @var Injector
     */
    private $injector;

    /**
     * Plugin constructor.
     *
     * @param Injector $injector Dependency Injection Container.
     */
    public function __construct(Injector $injector)
    {
        $this->injector = $injector;
    }

    /**
     * Run plugin
     *
     * @since 1.0.1
     *
     * @throws Exception Object doesn't exist.
     */
    public function run(): void
    {
	    is_admin()
		    ? $this->run_admin()
		    : $this->run_front();
    }

    /**
     * Run admin part
     *
     * @since 1.0.1
     *
     * @throws InjectionException If a cyclic gets detected when provisioning.
     */
    private function run_admin(): void
    {
        $this->injector->make(Settings::class)->hooks();
    }

    /**
     * Run frontend part
     *
     * @since 1.0.1
     *
     * @throws InjectionException If a cyclic gets detected when provisioning.
     */
    private function run_front(): void
    {
        $this->injector->make(Front::class, [$this])->hooks();
    }
}
