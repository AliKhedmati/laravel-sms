<?php

return [

    /**
     * Default SMS Driver.
     */

    'default-driver'   =>  env('SMS_DRIVER'),

    /*
     * All SMS drivers.
     */

    'drivers' =>  [
        'smsir' =>  [
            'api-key'   =>  env('SMS_SMSIR_API_KEY'),
            'secret-key'    =>  env('SMS_SMSIR_SECRET_KEY'),
            'line-number'   =>  env('SMS_SMSIR_LINE_NUMBER')
        ],
        'twilio'    =>  [
            'account-SID'   =>  env('SMS_TWILIO_ACCOUNT_SID'),
            'auth-token'   =>  env('SMS_TWILIO_AUTH_TOKEN'),
            'line-number'   =>  env('SMS_TWILIO_LINE_NUMBER')
        ],
        'asanak'    =>  [
            'username'  =>  env('SMS_ASANAK_USERNAME'),
            'password'  =>  env('SMS_ASANAK_PASSWORD'),
            'line-number'   =>  env('SMS_ASANAK_LINE_NUMBER')
        ],
    ],
];
