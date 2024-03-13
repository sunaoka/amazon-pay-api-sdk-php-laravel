<?php

declare(strict_types=1);

namespace Tests;

use Sunaoka\AmazonPay\Laravel\Facade\AmazonPay;
use Sunaoka\AmazonPay\Laravel\Provider\AmazonPayServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app): array
    {
        return [
            AmazonPayServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<string, class-string<\Illuminate\Support\Facades\Facade>>
     */
    protected function getPackageAliases($app): array
    {
        return [
            'AmazonPay' => AmazonPay::class,
        ];
    }

    /**
     * @param  \Illuminate\Foundation\Application|array{config: \Illuminate\Config\Repository}  $app
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('amazon-pay', [
            'public_key_id' => 'public_key_id',
            'private_key' => 'private_key',
            'sandbox' => true,
            'region' => 'us',
        ]);
    }
}
