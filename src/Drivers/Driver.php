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