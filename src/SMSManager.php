<?php

namespace Alikhedmati\SMS;

use Alikhedmati\SMS\Drivers\Kavenegar;
use Alikhedmati\SMS\Drivers\SMSIR;
use Alikhedmati\SMS\Drivers\Twilio;
use Illuminate\Support\Manager;

class SMSManager extends Manager
{
    public function createSmsirDriver(): SMSIR
    {
        return new SMSIR();
    }

    public function createTwilioDriver(): Twilio
    {
        return new Twilio();
    }

    public function createKavenegarDriver(): Kavenegar
    {
        return new Kavenegar();
    }

    public function getDefaultDriver(): string
    {

    }
}