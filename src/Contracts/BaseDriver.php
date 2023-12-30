<?php

namespace Alikhedmati\SMS\Contracts;

interface BaseDriver
{
    /**
     * @param string $baseUri
     * @return $this
     */

    public function setBaseUrl(string $baseUri): static;

    /**
     * @param string $apiKey
     * @return $this
     */

    public function setApiKey(string $apiKey): static;

    /**
     * @param string $mobile
     * @return $this
     */

    public function setMobile(string $mobile): static;
}