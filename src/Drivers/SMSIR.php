<?php

namespace Alikhedmati\SMS\Drivers;

use Alikhedmati\SMS\Contracts\DriverInterface;
use Alikhedmati\SMS\Exceptions\SMSException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SMSIR extends Driver implements DriverInterface
{
    const BASE_URL = 'https://RestfulSms.com/api/';

    public function __construct()
    {
        $this->setBaseUrl(self::BASE_URL);
        $this->setApiKey(Config::get('SMS.drivers.smsir.api-key'));
        $this->setSecretKey(Config::get('SMS.drivers.smsir.secret-key'));
        $this->setAccessToken($this->getCachedAccessToken());
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

        if ($request->getStatusCode() != 201){

            throw new SMSException(json_decode($request->getBody()->getContents())->Message, $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }

        return $request->Credit;
    }

    /**
     * @return Collection
     * @throws GuzzleException
     * @throws SMSException
     */

    public function sendTemplate(): Collection
    {
        $params = [];

        foreach ($this->getTemplateParameters() as $param => $value){

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
                'TemplateId' => $this->templateID,
            ],
        ]);

        if ($request->getStatusCode() != 201) {

            throw new SMSException(json_decode($request->getBody()->getContents())->Message, $request->getStatusCode());

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

    public function sendMessage(): Collection
    {
        $request = $this->getClient([
            'x-sms-ir-secure-token' =>  $this->accessToken
        ])->post('MessageSend', [
            'json' => [
                'Messages' => [$this->message],
                'MobileNumbers' => [$this->mobile],
                'LineNumber' => $this->lineNumber,
            ],
        ]);

        if ($request->getStatusCode() != 201){

            throw new SMSException(json_decode($request->getBody()->getContents())->Message, $request->getStatusCode());

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

        if ($request->getStatusCode() != 201){

            throw new SMSException(json_decode($request->getBody()->getContents())->Message, $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }

        return collect($request->Messages);
    }

    /**
     * @return string
     */

    protected function getCachedAccessToken(): string
    {
        return Cache::remember('smsir-access-token', Carbon::now()->addMinutes(30), function (){
            return $this->generateAccessToken();
        });
    }

    /**
     * @return string
     * @throws GuzzleException
     * @throws SMSException
     */

    public function generateAccessToken(): string
    {
        $request = $this->getClient()->post('Token', [
            'json' => [
                'UserApiKey' => $this->apiKey,
                'SecretKey' => $this->secretKey,
            ],
        ]);

        if ($request->getStatusCode() != 201) {

            throw new SMSException(json_decode($request->getBody()->getContents())->Message, $request->getStatusCode());

        }

        $request = json_decode($request->getBody()->getContents());

        if (!$request->IsSuccessful) {

            throw new SMSException($request->Message);

        }

        return $request->TokenKey;
    }
}