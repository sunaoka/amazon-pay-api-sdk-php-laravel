<?php

declare(strict_types=1);

namespace Tests;

use LogicException;
use Sunaoka\AmazonPay\Laravel\Client;
use Throwable;

class ClientTest extends TestCase
{
    /**
     * @throws Throwable
     */
    public function testPublicKeyIdRequired(): void
    {
        $this->expectException(LogicException::class);

        new Client([]);
    }

    /**
     * @throws Throwable
     */
    public function testPrivateKeyRequired(): void
    {
        $this->expectException(LogicException::class);

        new Client(['public_key_id' => 'public_key_id']);
    }

    /**
     * @throws Throwable
     */
    public function testRegionRequired(): void
    {
        $this->expectException(LogicException::class);

        new Client(['public_key_id' => 'public_key_id', 'private_key' => 'private_key']);
    }

    /**
     * @throws Throwable
     */
    public function testRegionInvalid(): void
    {
        $this->expectException(LogicException::class);

        new Client(['public_key_id' => 'public_key_id', 'private_key' => 'private_key', 'region' => 'zz']);
    }
}
