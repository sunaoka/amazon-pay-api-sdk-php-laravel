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
```
