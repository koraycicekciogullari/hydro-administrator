<?php

namespace Koraycicekciogullari\HydroAdministrator;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/hydro-administrator.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('hydro-administrator.php'),
        ], 'config');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/Routes/administrator-route.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'hydro-administrator'
        );
    }
}
