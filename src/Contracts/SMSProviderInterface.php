<?php

namespace Alikhedmati\SMS\Contracts;

interface SMSProviderInterface
{
    public function send(): void;

    public function getAccessToken(): string;
}