<?php

namespace Alikhedmati\SMS\Contracts;

use Illuminate\Support\Collection;

interface HasTemplateMessage
{
    /**
     * @param string $templateID
     * @return $this
     */

    public function setTemplateID(string $templateID): static;

    /**
     * @param array $parameters
     * @return $this
     */

    public function setTemplateParameters(array $parameters): static;

    /**
     * @return Collection
     */

    public function sendTemplate(): Collection;
}