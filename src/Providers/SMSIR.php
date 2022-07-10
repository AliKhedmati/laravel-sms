<?php

namespace Alikhedmati\SMS\Providers;

use Alikhedmati\SMS\Contracts\SMSProviderInterface;
use Alikhedmati\SMS\Exceptions\SMSException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SMSIR extends SMSProvider implements SMSProviderInterface
{
    const restApiBase = 'https://RestfulSms.com/api/';

    protected string $apiKey;

    protected string $secretKey;

    public function __construct()
    {
        $this->apiKey = config('sms.providers.smsir.api-key');

        $this->secretKey = config('sms.providers.smsir.secret-key');
    }

    /**
     * @throws GuzzleException
     * @throws SMSException
     */

    public function send(): void
    {
        $params = [];

        foreach ($this->parameters as $param => $value){

            $params[] = [
                'Parameter' =>  $param,
                'ParameterValue'    =>  $value
            ];

        }

        $request = $this->client(true)->post('UltraFastSend', [
            'json' => [
                'ParameterArray' => $params,
                'Mobile' => $this->mobile,
                'TemplateId' => $this->templateId,
            ],
        ]);

        if ($request->getStatusCode() != 201) {

            throw new SMSException($request->getBody()->getContents(), $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }
    }

    /**
     * @throws GuzzleException
     * @throws SMSException
     */

    private function client(bool $isAuthenticated = false): Client
    {
        $headers = [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
        ];

        if ($isAuthenticated) {

            $headers['x-sms-ir-secure-token'] = $this->getAccessToken();

        }

        return new Client([
            'headers' => $headers,
            'base_uri' => self::restApiBase,
            'http_error' => false
        ]);
    }

    /**
     * @return string
     * @throws GuzzleException
     * @throws SMSException
     */

    public function getAccessToken(): string
    {
        $request = $this->client()->post('Token', [
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