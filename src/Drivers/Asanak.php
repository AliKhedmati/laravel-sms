<?php

namespace Alikhedmati\SMS\Drivers;


use Alikhedmati\SMS\Contracts\HasLineMessage;
use Alikhedmati\SMS\Exceptions\SMSException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class Asanak extends Driver implements HasLineMessage
{
    const string BASE_URL = 'https://panel.asanak.com/webservice/v1rest/';

    public function __construct()
    {
        $this->setBaseUrl(self::BASE_URL);
        $this->setApiKey(Config::get('SMS.drivers.asanak.username'));
        $this->setSecretKey(Config::get('SMS.drivers.asanak.password'));
    }

    /**
     * @return Collection
     * @throws SMSException
     * @throws GuzzleException
     */

    public function sendMessage(): Collection
    {
        $request = $this->getClient()->post('sendsms', [
            'form_params' => [
                'username'    => $this->apiKey,
                'password'    => $this->secretKey,
                'Source'      => $this->lineNumber,
                'Message'     => $this->message,
                'destination' => $this->mobile,
            ],
        ]);

        if ($request->getStatusCode() != 200){

            throw new SMSException(json_decode($request->getBody()->getContents()), $request->getStatusCode());

        }

        return collect(json_decode($request->getBody()->getContents()));
    }
}