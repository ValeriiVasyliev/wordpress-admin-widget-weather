<?php

namespace WeatherWidget\Front;

if (! defined('ABSPATH')) {
    return;
}

use WeatherWidget\Plugin;

class Front
{
    /**
     * @var Plugin
     */
    private $plugin;

    /**
     * @param Plugin $plugin
     */
    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Init hooks
     */
    public function hooks(): void
    {

    }
}
