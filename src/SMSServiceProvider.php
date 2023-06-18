<?php

namespace Alikhedmati\SMS;

use Alikhedmati\SMS\Contracts\DriverInterface;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-SMS.php',
            'laravel-SMS'
        );

        $this->app->bind(DriverInterface::class, fn($app) => new SMSManager($app));
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-SMS.php' =>   config_path('laravel-SMS.php')
        ], 'config');
    }
}