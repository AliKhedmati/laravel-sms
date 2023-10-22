<?php

namespace Alikhedmati\SMS\Drivers;

use Alikhedmati\SMS\Contracts\DriverInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client as TwilioRestClient;

class Twilio extends Driver implements DriverInterface
{
    protected TwilioRestClient $twilio;

    /**
     * @throws ConfigurationException
     */

    public function __construct()
    {
        $this->setApiKey(Config::get('SMS.providers.twilio.account-SID'));
        $this->setSecretKey(Config::get('SMS.providers.twilio.auth-token'));
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

    public function sendTemplate(): Collection
    {
        // TODO: Implement sendTemplate() method.
    }

    public function getLog(Carbon $started_at, Carbon $ended_at, int $rows, int $pages): Collection
    {
        // TODO: Implement sendTemplate() method.
    }

    /**
     * @return string
     * @throws TwilioException
     */

    public function getCredit(): string
    {
        return '£'. $this->twilio->balance->fetch()->balance;
    }
}