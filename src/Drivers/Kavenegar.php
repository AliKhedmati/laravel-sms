<?php

namespace Alikhedmati\SMS\Drivers;

use Alikhedmati\SMS\Contracts\SMSProviderInterface;
use Alikhedmati\SMS\Providers\SMSProvider;

class Kavenegar extends SMSProvider implements SMSProviderInterface
{

    public function send(): void
    {
        // TODO: Implement send() method.
    }

    public function getAccessToken(): string
    {
        // TODO: Implement getAccessToken() method.
    }

    public function authenticate(): string
    {
        // TODO: Implement authenticate() method.
    }
}