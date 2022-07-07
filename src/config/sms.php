<?php

use Alikhedmati\SMS\Providers\Kavenegar;
use Alikhedmati\SMS\Providers\SMSIR;

return [

    /*
     * Active SMS Provider.
     */

    'provider'  =>  env('SMS_PROVIDER', 'smsir'),

    /*
     * All SMS Providers.
     */

    'providers' =>  [
        'smsir' =>  [
            'class' =>  SMSIR::class,
            'api-key'   =>  env('SMS_SMSIR_API_KEY'),
            'secret-key'    =>  env('SMS_SMSIR_SECRET_KEY')
        ],
        'kavenegar' =>  [
            'class' =>  Kavenegar::class,
            'api-key'   =>  env('SMS_KAVENEGAR_API_KEY')
        ]
    ],
];