<?php

namespace Alikhedmati\SMS\Drivers;

use Alikhedmati\SMS\Exceptions\SMSException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class SMSIR extends Driver
{
    const BASE_URI = 'https://RestfulSms.com/api/';
    protected string $apiKey;
    protected string $secretKey;
    protected string $accessToken;

    /**
     * @throws GuzzleException
     * @throws SMSException
     */

    public function __construct()
    {
        $this->apiKey = config('laravel-SMS.providers.smsir.api-key');
        $this->secretKey = config('laravel-SMS.providers.smsir.secret-key');
        $this->baseUrl = self::BASE_URI;
        $this->accessToken = $this->getAccessToken();
    }

    /**
     * @param array $parameters
     * @param string $templateID
     * @return Collection
     * @throws GuzzleException
     * @throws SMSException
     */

    public function sendTemplate(array $parameters, string $templateID): Collection
    {
        $params = [];

        foreach ($parameters as $param => $value){

            $params[] = [
                'Parameter' =>  $param,
                'ParameterValue'    =>  $value
            ];

        }

        $request = $this->getClient([
            'x-sms-ir-secure-token' =>  $this->accessToken
        ])->post('UltraFastSend', [
            'json' => [
                'ParameterArray' => $params,
                'Mobile' => $this->mobile,
                'TemplateId' => $templateID,
            ],
        ]);

        if ($request->getStatusCode() != 201) {

            throw new SMSException($request->getBody()->getContents(), $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }

        return collect($request);
    }

    /**
     * @return string
     * @throws GuzzleException
     * @throws SMSException
     */

    protected function getAccessToken(): string
    {
        $request = $this->getClient()->post('Token', [
            'json' => [
                'UserApiKey' => $this->apiKey,
                'SecretKey' => $this->secretKey,
            ],
        ]);

        if ($request->getStatusCode() != 201) {

            throw new SMSException($request->getBody()->getContents(), $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }

        return $request->TokenKey;
    }
}