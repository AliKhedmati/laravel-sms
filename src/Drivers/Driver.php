<?php

namespace Alikhedmati\SMS\Drivers;

use GuzzleHttp\Client;

class Driver
{
    /**
     * @var string
     */

    public string $baseUrl;

    /**
     * @var string
     */

    public string $apiKey;

    /**
     * @var string
     */

    public string $mobile;

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
     * @return Client
     */

    protected function getClient(): Client
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        return new Client([
            'base_uri'  =>  $this->getBaseurl(),
            'headers'   =>  $headers,
            'http_errors'   =>  false
        ]);
    }
}