<?php

namespace Alikhedmati\SMS;

use Alikhedmati\SMS\Drivers\SMSIR;
use Alikhedmati\SMS\Drivers\Twilio;
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
     * @return string
     */

    public function getDefaultDriver(): string
    {
        return 'smsir';
    }
}