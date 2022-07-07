<?php

namespace Alikhedmati\SMS;

use Alikhedmati\SMS\Contracts\SMSInterface;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/sms.php',
            'sms'
        );

        $this->app->bind(SMSInterface::class, fn() => new SMS());
    }

    public function boot()
    {
        $this->offerPublishing();
    }

    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ .'/config/sms.php'   =>   config_path('sms.php')
        ], 'config');
    }
}