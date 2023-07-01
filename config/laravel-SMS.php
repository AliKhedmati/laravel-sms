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
        'twilio'    =>  [
            'account-SID'   =>  env('SMS_TWILIO_ACCOUNT_SID'),
            'auth-token'   =>  env('SMS_TWILIO_AUTH_TOKEN'),
            'line-number'   =>  env('SMS_TWILIO_LINE_NUMBER')
        ],
    ],
];