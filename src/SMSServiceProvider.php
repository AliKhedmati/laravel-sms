<?php

namespace Alikhedmati\SMS;

use Alikhedmati\SMS\Contracts\DriverInterface;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/SMS.php',
            'SMS'
        );

        $this->app->bind('SMS', fn($app) => new SMSManager($app));
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/SMS.php' =>   config_path('SMS.php')
        ], 'config');
    }
}