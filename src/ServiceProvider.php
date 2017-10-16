<?php

namespace DALTCORE\MdcSignOn;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/mdc-sign-on.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('mdc-sign-on.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'mdc-sign-on'
        );

    }
}
