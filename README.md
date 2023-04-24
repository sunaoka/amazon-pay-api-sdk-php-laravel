# Amazon Pay API SDK (PHP) for Laravel

[![Latest Stable Version](https://poser.pugx.org/sunaoka/amazon-pay-api-sdk-php-laravel/v/stable)](https://packagist.org/packages/sunaoka/amazon-pay-api-sdk-php-laravel)
[![License](https://poser.pugx.org/sunaoka/amazon-pay-api-sdk-php-laravel/license)](https://packagist.org/packages/sunaoka/amazon-pay-api-sdk-php-laravel)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/sunaoka/amazon-pay-api-sdk-php-laravel)](composer.json)
[![Laravel](https://img.shields.io/badge/laravel-6.x%20%7C%207.x%20%7C%208.x%20%7C%209.x%20%7C%2010.x-red)](https://laravel.com/)
[![Test](https://github.com/sunaoka/amazon-pay-api-sdk-php-laravel/actions/workflows/test.yml/badge.svg)](https://github.com/sunaoka/amazon-pay-api-sdk-php-laravel/actions/workflows/test.yml)
[![codecov](https://codecov.io/gh/sunaoka/amazon-pay-api-sdk-php-laravel/branch/main/graph/badge.svg?token=B69XU9TMMH)](https://codecov.io/gh/sunaoka/amazon-pay-api-sdk-php-laravel)

----

This library is The Laravel Framework binding for [amazon-pay-api-sdk-php](https://github.com/amzn/amazon-pay-api-sdk-php).

## Installation

```bash
composer require sunaoka/amazon-pay-api-sdk-php-laravel
```

## Configurations

```bash
php artisan vendor:publish --tag=amazon-pay-config
```

The settings can be found in the generated `config/amazon-pay.php` configuration file.

```php
<?php

return [
    'sandbox'              => (bool)env('AMAZON_PAY_SANDBOX', 'true'),
    'merchant_id'          => env('AMAZON_PAY_MERCHANT_ID'),
    'store_id'             => env('AMAZON_PAY_STORE_ID'),
    'public_key_id'        => env('AMAZON_PAY_PUBLIC_KEY_ID'),
    'private_key'          => env('AMAZON_PAY_PRIVATE_KEY'),
    'region'               => env('AMAZON_PAY_REGION'),
    'language'             => env('AMAZON_PAY_LANGUAGE'),
    'currency_code'        => env('AMAZON_PAY_CURRENCY_CODE'),
    'algorithm'            => env('AMAZON_PAY_ALGORITHM'),
    'override_service_url' => env('AMAZON_PAY_OVERRIDE_SERVICE_URL'),
    'proxy'                => !empty(env('AMAZON_PAY_PROXY_HOST')) ? [
        'host'     => env('AMAZON_PAY_PROXY_HOST'),
        'port'     => env('AMAZON_PAY_PROXY_PORT'),
        'username' => env('AMAZON_PAY_PROXY_USERNAME'),
        'password' => env('AMAZON_PAY_PROXY_PASSWORD'),
    ] : null,
];
```

## Usage

```dotenv
# .env
AMAZON_PAY_SANDBOX=true
AMAZON_PAY_MERCHANT_ID=ABC123DEF456XY
AMAZON_PAY_STORE_ID=amzn1.application-oa2-client.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
AMAZON_PAY_PUBLIC_KEY_ID=ABC123DEF456XYZ789IJK000
AMAZON_PAY_PRIVATE_KEY=keys/private.pem
AMAZON_PAY_REGION=us
AMAZON_PAY_LANGUAGE=en_US
AMAZON_PAY_CURRENCY_CODE=USD
```

```php
<?php

$payload = [
    'storeId'            => config('amazon-pay.store_id'),
    'webCheckoutDetails' => [
        'checkoutReviewReturnUrl' => 'http://localhost/checkout/review',
        'checkoutResultReturnUrl' => 'http://localhost/checkout/result',
        'checkoutCancelUrl'       => 'http://localhost/checkout/cancel',
    ],
];

$signature = \AmazonPay::generateButtonSignature($payload);

$button = [
    'merchantId'                  => config('amazon-pay.merchant_id'),
    'ledgerCurrency'              => config('amazon-pay.currency_code'),
    'sandbox'                     => config('amazon-pay.sandbox'),
    'checkoutLanguage'            => config('amazon-pay.language'),
    'productType'                 => 'PayAndShip',
    'placement'                   => 'Cart',
    'createCheckoutSessionConfig' => [
        'payloadJSON' => $payload,
        'signature'   => $signature,
        'publicKeyId' => config('amazon-pay.public_key_id'),
        'algorithm'   => config('amazon-pay.algorithm'),
    ],
];
```

```html
<body>
    <div id="AmazonPayButton"></div>

    <script src="{{ \AmazonPay::getAmazonPayScript() }}"></script>
    <script type="text/javascript" charset="utf-8">
        amazon.Pay.renderButton('#AmazonPayButton', @json($button));
    </script>
</body>
```

## Testing

You may use the `AmazonPay` facade's `fake` method to apply the mock response.

```php
<?php

\AmazonPay::fake([
    'refundId'           => 'S01-5105180-3221187-R022311',
    'chargeId'           => 'S01-5105180-3221187-C056351',
    'refundAmount'       => [
        'amount'       => '14.00',
        'currencyCode' => 'USD'
    ],
    'softDescriptor'     => 'Descriptor',
    'creationTimestamp'  => '20190714T155300Z',
    'statusDetails'      => [
        'state'                => 'RefundInitiated',
        'reasonCode'           => null,
        'reasonDescription'    => null,
        'lastUpdatedTimestamp' => '20190714T155300Z'
    ],
    'releaseEnvironment' => 'Sandbox',
]);

$payload = [
    'chargeId'       => 'S01-5105180-3221187-C056351',
    'refundAmount'   => [
        'amount'       => '14.00',
        'currencyCode' => 'USD',
    ],
    'softDescriptor' => 'Descriptor',
];

$response = \AmazonPay::createRefund($payload, []);
$result = json_decode($response['response'], true);

echo $result['refundId']; // S01-5105180-3221187-R022311
```
