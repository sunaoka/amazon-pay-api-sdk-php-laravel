<?php

declare(strict_types=1);

namespace Tests;

use Sunaoka\AmazonPay\Laravel\Client;

class ClientTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function test_public_key_id_required(): void
    {
        $this->expectException(\LogicException::class);

        new Client([]);
    }

    /**
     * @throws \Exception
     */
    public function test_private_key_required(): void
    {
        $this->expectException(\LogicException::class);

        new Client(['public_key_id' => 'public_key_id']);
    }

    /**
     * @throws \Exception
     */
    public function test_region_required(): void
    {
        $this->expectException(\LogicException::class);

        new Client(['public_key_id' => 'public_key_id', 'private_key' => 'private_key']);
    }

    /**
     * @throws \Exception
     */
    public function test_region_invalid(): void
    {
        $this->expectException(\LogicException::class);

        new Client(['public_key_id' => 'public_key_id', 'private_key' => 'private_key', 'region' => 'zz']);
    }
}
