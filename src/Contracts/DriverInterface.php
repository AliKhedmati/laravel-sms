<?php

namespace Alikhedmati\SMS\Contracts;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

interface DriverInterface
{
    public function setBaseUrl(string $baseUri): static;
    public function getBaseUrl(): string;
    public function setApiKey(string $apiKey): static;
    public function getApiKey(): string;
    public function setLineNumber(string $lineNumber): static;
    public function getLineNumber(): string;
    public function setMessage(string $message): static;
    public function getMessage(): string;
    public function setMobile(string $mobile): static;
    public function getMobile(): string;

    public function sendMessage(): Collection;

    public function sendTemplate(): Collection;
    public function getLog(Carbon $started_at, Carbon $ended_at, int $rows, int $pages): Collection;

    public function getCredit(): string;
    public function setTemplateID(string $templateID): static;
    public function getTemplateID(): string;
    public function setTemplateParameters(array $parameters): static;
    public function getTemplateParameters(): array;
}