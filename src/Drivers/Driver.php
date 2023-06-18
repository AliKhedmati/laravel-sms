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
     * @return string
     */

    public function getBaseUrl(): string
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
     * @param string $mobile
     * @return $this
     */

    public function setMobile(string $mobile): static
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * @return string
     */

    public function getMobile(): string
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
     * @return string
     */

    public function getTemplateID(): string
    {
        return $this->templateID;
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

    /**
     * @return array
     */

    public function getTemplateParameters(): array
    {
        return $this->templateParameters;
    }
}