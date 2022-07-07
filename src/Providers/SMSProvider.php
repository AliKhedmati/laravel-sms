<?php

namespace Alikhedmati\SMS\Providers;

class SMSProvider
{
    public string $mobile;

    public array $parameters;

    public int $templateId;

    public function setMobile(string $mobile): static
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function setParameters(array $parameters): static
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function setTemplateId(int $templateId): static
    {
        $this->templateId = $templateId;

        return $this;
    }
}