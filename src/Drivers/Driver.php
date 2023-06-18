<?php

namespace Alikhedmati\SMS\Drivers;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class Driver
{
    /**
     * @var string
     */

    protected string $baseUrl;

    /**
     * @var string
     */

    protected string $apiKey;

    /**
     * @var string
     */

    protected string $mobile;

    /**
     * @var string
     */

    protected string $lineNumber;

    /**
     * @var string
     */

    protected string $message;



    /**
     * @param string $baseurl
     * @return $this
     */

    public function setBaseurl(string $baseurl): static
    {
        $this->baseUrl = $baseurl;

        return $this;
    }

    /**
     * @return string
     */

    public function getBaseurl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $lineNumber
     * @return $this
     */

    public function setLineNumber(string $lineNumber): static
    {
        $this->lineNumber = $lineNumber;

        return $this;
    }

    /**
     * @return string
     */

    public function getLineNumber(): string
    {
        return $this->lineNumber;
    }

    /**
     * @param string $message
     * @return $this
     */

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $apiKey
     * @return $this
     */

    public function setApiKey(string $apiKey): static
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string
     */

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string|null $mobile
     * @return $this
     */

    public function setMobile(string|null $mobile): static
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * @return string|null
     */

    public function getMobile(): string|null
    {
        return $this->mobile;
    }

    /**
     * @param array $headers
     * @return Client
     */

    protected function getClient(array $headers = []): Client
    {
        $headers = collect($headers)->merge([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->flatten()->toArray();

        return new Client([
            'base_uri'  =>  $this->getBaseurl(),
            'headers'   =>  $headers,
            'http_errors'   =>  false
        ]);
    }
}