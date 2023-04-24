<?php

declare(strict_types=1);

namespace Tests;

use Sunaoka\AmazonPay\Laravel\Facade\AmazonPay;
use Sunaoka\AmazonPay\Laravel\Provider\AmazonPayServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @inerhitDoc
     */
    protected function getPackageProviders($app): array
    {
        return [
            AmazonPayServiceProvider::class,
        ];
    }

    /**
     * @inerhitDoc
     */
    protected function getPackageAliases($app): array
    {
        return [
            'AmazonPay' => AmazonPay::class,
        ];
    }

    /**
     * @inerhitDoc
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('amazon-pay', [
            'public_key_id' => 'public_key_id',
            'private_key'   => 'private_key',
            'sandbox'       => true,
            'region'        => 'us',
        ]);
    }
}
