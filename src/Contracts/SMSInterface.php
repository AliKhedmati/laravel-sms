<?php

namespace Alikhedmati\SMS\Contracts;

interface SMSInterface
{
    public function send();

    public function setProvider(string $provider);

    public function setMobile(string $mobile);

    public function setParameters(array $data);

    public function setTemplateId(int $templateId);
}