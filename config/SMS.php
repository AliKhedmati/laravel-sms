<?php

return [

    /*
     * All SMS drivers.
     */

    'drivers' =>  [
        'smsir' =>  [
            'api-key'   =>  env('SMS_SMSIR_API_KEY'),
            'secret-key'    =>  env('SMS_SMSIR_SECRET_KEY')
        ],
        'twilio'    =>  [
            'account-SID'   =>  env('SMS_TWILIO_ACCOUNT_SID'),
            'auth-token'   =>  env('SMS_TWILIO_AUTH_TOKEN'),
        ],
        'asanak'    =>  [
            'username'  =>  env('SMS_SMSIR_API_KEY'),
            'password'  =>  env('SMS_SMSIR_API_KEY')
        ],
    ],
];