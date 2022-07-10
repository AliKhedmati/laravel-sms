<?php

namespace Alikhedmati\SMS\Providers;

use Alikhedmati\SMS\Contracts\SMSProviderInterface;
use Alikhedmati\SMS\Exceptions\SMSException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Redis;

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

            throw new SMSException('Failed to get data from SMS.ir Api', $request->getStatusCode());

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
     * @throws GuzzleException
     * @throws SMSException
     */

    public function getAccessToken(): string
    {
        /**
         * Check if redis has access-token or not.
         */

        $accessToken = Redis::get('smsir-access-token');

        if ($accessToken){

            /**
             * todo: Make a call to /profile endpoint to ensure that access token is valid.
             */

            /**
             * Return access-token.
             */

            return decrypt($accessToken);

        }

        /**
         * Fetch new access-token.
         */

        $accessToken = $this->authenticate();


        /**
         * Store access-token in redis.
         */

        Redis::set('smsir-access-token', encrypt($accessToken), 10);

        /**
         * Return access-token.
         */

        return $accessToken;
    }

    /**
     * @return string
     * @throws GuzzleException
     * @throws SMSException
     */

    public function authenticate(): string
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