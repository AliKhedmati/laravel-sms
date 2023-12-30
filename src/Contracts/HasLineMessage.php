<?php

namespace Alikhedmati\SMS\Contracts;

use Illuminate\Support\Collection;

interface HasLineMessage
{
    /**
     * @param string $lineNumber
     * @return $this
     */

    public function setLineNumber(string $lineNumber): static;

    /**
     * @param string $message
     * @return $this
     */

    public function setMessage(string $message): static;

    /**
     * @return Collection
     */

    public function sendMessage(): Collection;
}