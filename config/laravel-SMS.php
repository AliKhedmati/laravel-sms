<?php

return [

    /*
     * Active SMS Provider.
     */

    'default-driver'  =>  env('SMS_PROVIDER', 'smsir'),

    /*
     * All SMS Providers.
     */

    'providers' =>  [
        'smsir' =>  [
            'api-key'   =>  env('SMS_SMSIR_API_KEY'),
            'secret-key'    =>  env('SMS_SMSIR_SECRET_KEY')
        ],
        'kavenegar' =>  [
            'api-key'   =>  env('SMS_KAVENEGAR_API_KEY')
        ]
    ],
];