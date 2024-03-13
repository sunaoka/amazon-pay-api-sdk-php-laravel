<?php

declare(strict_types=1);

namespace Sunaoka\AmazonPay\Laravel\Provider;

use Illuminate\Support\ServiceProvider;
use Sunaoka\AmazonPay\Laravel\Client;

class AmazonPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__, 2).'/config/amazon-pay.php',
            'amazon-pay'
        );

        $this->app->singleton('AmazonPay', function ($app) {
            $config = $app->make('config')->get('amazon-pay');

            return new Client($config);
        });

        $this->app->alias('AmazonPay', Client::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [dirname(__DIR__, 2).'/config/amazon-pay.php' => $this->app->configPath('amazon-pay.php')],
                'amazon-pay-config'
            );
        }
    }
}
