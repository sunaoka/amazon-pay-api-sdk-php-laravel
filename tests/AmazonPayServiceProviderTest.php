<?php

declare(strict_types=1);

namespace Tests;

class AmazonPayServiceProviderTest extends TestCase
{
    public function testFacade(): void
    {
        $actual = \AmazonPay::__get('sandbox');
        self::assertTrue($actual);
    }
}
