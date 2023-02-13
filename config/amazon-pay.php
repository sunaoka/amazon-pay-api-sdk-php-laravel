<?php

return [
    'sandbox'       => (bool)env('AMAZON_PAY_SANDBOX', 'true'),
    'merchant_id'   => env('AMAZON_PAY_MERCHANT_ID'),
    'store_id'      => env('AMAZON_PAY_STORE_ID'),
    'public_key_id' => env('AMAZON_PAY_PUBLIC_KEY_ID'),
    'private_key'   => env('AMAZON_PAY_PRIVATE_KEY'),
    'region'        => env('AMAZON_PAY_REGION'),
    'language'      => env('AMAZON_PAY_LANGUAGE'),
    'currency_code' => env('AMAZON_PAY_CURRENCY_CODE'),
    'algorithm'     => env('AMAZON_PAY_ALGORITHM'),
    'proxy'         => [
        'host'     => env('AMAZON_PAY_PROXY_HOST'),
        'port'     => env('AMAZON_PAY_PROXY_PORT'),
        'username' => env('AMAZON_PAY_PROXY_USERNAME'),
        'password' => env('AMAZON_PAY_PROXY_PASSWORD'),
    ],
];
