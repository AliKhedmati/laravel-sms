<?php

namespace Alikhedmati\SMS;

use Alikhedmati\SMS\Contracts\SMSInterface;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SMSInterface::class, fn() => new SMS());
    }
}