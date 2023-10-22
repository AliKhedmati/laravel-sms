<?php

namespace Alikhedmati\SMS\Facades;

use Illuminate\Support\Facades\Facade;

class SMS extends Facade
{
    /**
     * @return string
     */

    protected static function getFacadeAccessor(): string
    {
        return 'SMS';
    }
}