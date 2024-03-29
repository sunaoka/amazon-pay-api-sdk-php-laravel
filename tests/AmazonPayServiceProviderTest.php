<?php

declare(strict_types=1);

namespace Tests;

class AmazonPayServiceProviderTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testFacade(): void
    {
        $actual = \AmazonPay::__get('sandbox');
        self::assertTrue($actual);
    }

    /**
     * @throws \Exception
     */
    public function testGetAmazonPayScript(): void
    {
        $actual = \AmazonPay::getAmazonPayScript();
        self::assertSame('https://static-na.payments-amazon.com/checkout.js', $actual);
    }

    public function testFake(): void
    {
        $fakeResponse = [
            'refundId' => 'S01-5105180-3221187-R022311',
            'chargeId' => 'S01-5105180-3221187-C056351',
            'refundAmount' => [
                'amount' => '14.00',
                'currencyCode' => 'USD',
            ],
            'softDescriptor' => 'Descriptor',
            'creationTimestamp' => '20190714T155300Z',
            'statusDetails' => [
                'state' => 'RefundInitiated',
                'reasonCode' => null,
                'reasonDescription' => null,
                'lastUpdatedTimestamp' => '20190714T155300Z',
            ],
            'releaseEnvironment' => 'Sandbox',
        ];

        \AmazonPay::fake($fakeResponse);

        $payload = [
            'chargeId' => 'S01-5105180-3221187-C056351',
            'refundAmount' => [
                'amount' => '14.00',
                'currencyCode' => 'USD',
            ],
            'softDescriptor' => 'Descriptor',
        ];

        $actual = \AmazonPay::createRefund($payload, []);

        /** @var array{refundId: string} $response */
        $response = json_decode($actual['response'], true);

        self::assertSame($fakeResponse['refundId'], $response['refundId']);

        \AmazonPay::fake($fakeResponse);

        $actual = \AmazonPay::getRefund('S01-5105180-3221187-R022311');

        /** @var array{refundId: string} $response */
        $response = json_decode($actual['response'], true);

        self::assertSame($fakeResponse['refundId'], $response['refundId']);
    }
}
