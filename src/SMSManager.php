<?php

namespace Alikhedmati\SMS;

use Alikhedmati\SMS\Drivers\Asanak;
use Alikhedmati\SMS\Drivers\SMSIR;
use Alikhedmati\SMS\Drivers\Twilio;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Manager;

class SMSManager extends Manager
{
    /**
     * @return SMSIR
     */

    public function createSmsirDriver(): SMSIR
    {
        return new SMSIR();
    }

    /**
     * @return Twilio
     */

    public function createTwilioDriver(): Twilio
    {
        return new Twilio();
    }

    /**
     * @return Asanak
     */

    public function createAsanakDriver(): Asanak
    {
        return new Asanak();
    }

    /**
     * @return string
     */

    public function getDefaultDriver(): string
    {
        return Config::get('SMS.default-driver');
    }
}