<?php

namespace Alikhedmati\SMS\Drivers;

use GuzzleHttp\Client;

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

    protected string $secretKey;

    /**
     * @var string
     */

    protected string $accessToken;

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
     * @var string
     */

    protected string $templateID;

    /**
     * @var array
     */

    protected array $templateParameters;


    /**
     * @param string $baseUrl
     * @return $this
     */

    public function setBaseUrl(string $baseUrl): static
    {
        $this->baseUrl = $baseUrl;

        return $this;
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
     * @param string $message
     * @return $this
     */

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
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
     * @param string $accessToken
     * @return $this
     */

    public function setAccessToken(string $accessToken): static
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @param string $secretKey
     * @return $this
     */

    public function setSecretKey(string $secretKey): static
    {
        $this->secretKey = $secretKey;

        return $this;
    }

    /**
     * @param string $mobile
     * @return $this
     */

    public function setMobile(string $mobile): static
    {
        $this->mobile = $mobile;

        return $this;
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
        ])->toArray();

        return new Client([
            'base_uri'  =>  $this->baseUrl,
            'headers'   =>  $headers,
            'http_errors'   =>  false
        ]);
    }

    /**
     * @param string $templateID
     * @return $this
     */

    public function setTemplateID(string $templateID): static
    {
        $this->templateID = $templateID;

        return $this;
    }

    /**
     * @param array $parameters
     * @return $this
     */

    public function setTemplateParameters(array $parameters): static
    {
        $this->templateParameters = $parameters;

        return $this;
    }
}