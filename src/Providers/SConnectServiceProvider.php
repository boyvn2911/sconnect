<?php

namespace SonLeu\SConnect\Providers;

use SonLeu\SConnect\Auth\Guards\SConnectGuard;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class SConnectServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/s_connect.php' => config_path('s_connect.php'),
        ], 's_connect_config');

        Auth::extend('sconnect', function (Container $app) {
            return new SConnectGuard($app['request']);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/s_connect.php', 's_connect');

        $this->mergeConfigFrom(__DIR__ . '/../Config/guard.php', 'auth.guards');
    }
}
