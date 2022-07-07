<?php

namespace Alikhedmati\SMS;

use Alikhedmati\SMS\Contracts\SMSInterface;
use Alikhedmati\SMS\Exceptions\SMSException;

class SMS implements SMSInterface
{
    protected string $provider;

    protected string $mobile;

    protected array $parameters;

    protected int $templateId;

    public function __construct()
    {
        $this->provider = config('sms.provider');
    }

    /**
     * @throws SMSException
     */

    public function send(): void
    {
        $this->getProviderByName($this->provider)
            ->setMobile($this->mobile)
            ->setParameters($this->parameters)
            ->setTemplateId($this->templateId)
            ->send();
    }

    /**
     * @param string $provider
     * @return $this
     */

    public function setProvider(string $provider): static
    {
        $this->provider = $provider;

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
     * @param int $templateId
     * @return $this
     */

    public function setTemplateId(int $templateId): static
    {
        $this->templateId = $templateId;

        return $this;
    }

    /**
     * @param array $parameters
     * @return $this
     */

    public function setParameters(array $parameters): static
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @param string $provider
     * @return mixed
     * @throws SMSException
     */

    protected function getProviderByName(string $provider): mixed
    {
        if (!array_key_exists($provider, config('sms.providers'))){

            throw new SMSException(__('Provider Not Found.'));

        }

        $class = config('sms.providers.' . $provider . '.class');

        return new $class;
    }
}