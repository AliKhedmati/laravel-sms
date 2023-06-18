<?php

namespace Alikhedmati\SMS\Drivers;

use Alikhedmati\SMS\Exceptions\SMSException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class SMSIR extends Driver
{
    const BASE_URL = 'https://RestfulSms.com/api/';

    /**
     * @throws GuzzleException
     * @throws SMSException
     */

    public function __construct()
    {
        $this->apiKey = config('laravel-SMS.providers.smsir.api-key');
        $this->secretKey = config('laravel-SMS.providers.smsir.secret-key');
        $this->baseUrl = self::BASE_URL;
        $this->accessToken = $this->getAccessToken();
    }

    /**
     * @return string
     * @throws GuzzleException
     * @throws SMSException
     */

    public function getCredit(): string
    {
        $request = $this->getClient([
            'x-sms-ir-secure-token' =>  $this->accessToken
        ])->get('credit');

        if ($request->getStatusCode() != 200){

            throw new SMSException($request->getBody()->getContents(), $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }

        return $request->Credit;
    }

    /**
     * @param array $parameters
     * @param string $templateID
     * @return Collection
     * @throws GuzzleException
     * @throws SMSException
     */

    public function sendTemplate(string $templateID, array $parameters): Collection
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
     * @return Collection
     * @throws GuzzleException
     * @throws SMSException
     */

    public function sendRaw(): Collection
    {
        $request = $this->getClient([
            'x-sms-ir-secure-token' =>  $this->accessToken
        ])->post('MessageSend', [
            'json' => [
                'Messages' => [$this->getMessage()],
                'MobileNumbers' => [$this->getMobile()],
                'LineNumber' => $this->getLineNumber(),
            ],
        ]);

        if ($request->getStatusCode() != 201){

            throw new SMSException($request->getBody()->getContents(), $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }

        return collect($request);
    }

    /**
     * @param Carbon $started_at
     * @param Carbon $ended_at
     * @param int $rows
     * @param int $pages
     * @return Collection
     * @throws GuzzleException
     * @throws SMSException
     */

    public function getLog(Carbon $started_at, Carbon $ended_at, int $rows, int $pages): Collection
    {
        $request = $this->getClient([
            'x-sms-ir-secure-token' =>  $this->accessToken
        ])->get('MessageSend', [
            'query' => [
                'Shamsi_FromDate' => verta($started_at)->format('Y/m/d'),
                'Shamsi_ToDate' => verta($ended_at)->format('Y/m/d'),
                'RowsPerPage' => $rows,
                'RequestedPageNumber' => $pages
            ],
        ]);

        if ($request->getStatusCode() != 200){

            throw new SMSException($request->getBody()->getContents(), $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }

        return collect($request->Messages);
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