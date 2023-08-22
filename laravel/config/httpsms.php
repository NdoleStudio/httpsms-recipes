<?php

return [
    'webhook' => [
        /*
         * Signing key used to generate the JWT token which authenticates API requests, you can get this key
         * by following the instructions here https://docs.httpsms.com/webhooks/introduction
         */
        'signing_key' => env('HTTPSMS_WEBHOOK_SIGNING_KEY', ''),
    ]
];
