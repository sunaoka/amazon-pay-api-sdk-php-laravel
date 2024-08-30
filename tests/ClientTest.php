<?php

declare(strict_types=1);

namespace Tests;

use Sunaoka\AmazonPay\Laravel\Client;

class ClientTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testPublicKeyIdRequired(): void
    {
        $this->expectException(\LogicException::class);

        new Client([]);
    }

    /**
     * @throws \Exception
     */
    public function testPrivateKeyRequired(): void
    {
        $this->expectException(\LogicException::class);

        new Client(['public_key_id' => 'public_key_id']);
    }

    /**
     * @throws \Exception
     */
    public function testRegionRequired(): void
    {
        $this->expectException(\LogicException::class);

        new Client(['public_key_id' => 'public_key_id', 'private_key' => 'private_key']);
    }

    /**
     * @throws \Exception
     */
    public function testRegionInvalid(): void
    {
        $this->expectException(\LogicException::class);

        new Client(['public_key_id' => 'public_key_id', 'private_key' => 'private_key', 'region' => 'zz']);
    }
}
