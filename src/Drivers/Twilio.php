<?php

namespace Alikhedmati\SMS\Drivers;

use Alikhedmati\SMS\Contracts\BaseDriver;
use Alikhedmati\SMS\Contracts\HasLineMessage;
use Alikhedmati\SMS\Contracts\HasStatistics;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client as TwilioRestClient;

class Twilio extends Driver implements BaseDriver, HasLineMessage, HasStatistics
{
    protected TwilioRestClient $twilio;

    /**
     * @throws ConfigurationException
     */

    public function __construct()
    {
        $this->setApiKey(Config::get('SMS.drivers.twilio.account-SID'));
        $this->setSecretKey(Config::get('SMS.drivers.twilio.auth-token'));
        $this->twilio = new TwilioRestClient(
            username: $this->apiKey,
            password: $this->secretKey
        );
    }

    /**
     * @return Collection
     * @throws TwilioException
     */

    public function sendMessage(): Collection
    {
        $message = $this->twilio->messages->create(
            $this->mobile, [
                'from'  =>  $this->lineNumber,
                'body'  =>  $this->message
            ]
        );

        return collect($message->toArray());
    }

    /**
     * @return string
     * @throws TwilioException
     */

    public function getCredit(): string
    {
        return '£'. $this->twilio->balance->fetch()->balance;
    }

    /**
     * @param Carbon $started_at
     * @param Carbon $ended_at
     * @param int $rows
     * @param int $pages
     * @return Collection
     */
    public function getLog(Carbon $started_at, Carbon $ended_at, int $rows, int $pages): Collection
    {
        // TODO: Implement getLog() method.
    }
}