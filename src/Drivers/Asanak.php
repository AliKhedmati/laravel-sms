<?php

namespace Alikhedmati\SMS\Drivers;

use Alikhedmati\SMS\Contracts\DriverInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class Asanak extends Driver implements DriverInterface
{
    const BASE_URL = 'https://panel.asanak.com/webservice/v1rest/';

    public function __construct()
    {
        $this->setBaseUrl(self::BASE_URL);
        $this->setApiKey(Config::get('SMS.drivers.asanak.username'));
        $this->setSecretKey(Config::get('SMS.drivers.asanak.password'));
    }

    public function sendMessage(): Collection
    {
        // TODO: Implement sendMessage() method.
    }

    public function sendTemplate(): Collection
    {
        // TODO: Implement sendTemplate() method.
    }

    public function getLog(Carbon $started_at, Carbon $ended_at, int $rows, int $pages): Collection
    {
        // TODO: Implement getLog() method.
    }

    public function getCredit(): string
    {
        // TODO: Implement getCredit() method.
    }
}