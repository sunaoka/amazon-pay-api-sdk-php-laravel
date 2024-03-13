<?php

declare(strict_types=1);

namespace Sunaoka\AmazonPay\Laravel\Facade;

use Illuminate\Support\Facades\Facade;
use Sunaoka\AmazonPay\Laravel\Client;

/**
 * @method static \Mockery\MockInterface spy() Convert the facade into a Mockery spy.
 * @method static \Mockery\MockInterface partialMock() Initiate a partial mock on the facade.
 * @method static \Mockery\Expectation shouldReceive(string|array ...$methodNames) Initiate a mock expectation on the facade.
 * @method static void swap($instance) Hotswap the underlying instance behind the facade.
 * @method static void clearResolvedInstance(string $name) Clear a resolved facade instance.
 * @method static void clearResolvedInstances() Clear all of the resolved instances.
 *
 * @mixin Client
 */
class AmazonPay extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'AmazonPay';
    }
}
