<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;
use Sunaoka\AmazonPay\Laravel\Facade\AmazonPay;
use Sunaoka\AmazonPay\Laravel\Provider\AmazonPayServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param  Application  $app
     * @return array<int, class-string<ServiceProvider>>
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
     * @param  Application  $app
     * @return array<string, class-string<Facade>>
     */
    protected function getPackageAliases($app): array
    {
        return [
            'AmazonPay' => AmazonPay::class,
        ];
    }

    /**
     * @param  Application|array{config: Repository}  $app
     */
    protected function defineEnvironment($app): void
    {
        tap($app['config'], static function (Repository $config) {
            $config->set('amazon-pay', [
                'public_key_id' => 'public_key_id',
                'private_key' => 'private_key',
                'sandbox' => true,
                'region' => 'us',
            ]);
        });
    }
}
