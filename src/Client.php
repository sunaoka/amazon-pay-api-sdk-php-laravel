<?php

declare(strict_types=1);

namespace Sunaoka\AmazonPay\Laravel;

use Illuminate\Support\Str;

class Client extends \Amazon\Pay\API\Client
{
    /**
     * @var array|null
     */
    protected $fakeResponse;

    /**
     * @var int
     */
    protected $fakeStatus = 200;

    /**
     * @var string[]
     */
    protected $availableRegions = [
        'eu',
        'de',
        'uk',
        'us',
        'na',
        'jp',
    ];

    /**
     * @param  array|null  $config
     *
     * @throws \Exception
     */
    public function __construct($config = null)
    {
        if (empty($config['public_key_id'])) {
            throw new \LogicException('The "public_key_id" is required');
        }

        if (empty($config['private_key'])) {
            throw new \LogicException('The "private_key" is required');
        }

        if (empty($config['region'])) {
            throw new \LogicException('The "region" is required');
        }

        if (! in_array(strtolower($config['region']), $this->availableRegions, true)) {
            throw new \LogicException("{$config['region']} is not a valid region");
        }

        parent::__construct($config);
    }

    /**
     * Get Amazon Pay script URL
     *
     * @throws \Exception
     */
    public function getAmazonPayScript(): string
    {
        $scripts = [
            'na' => 'https://static-na.payments-amazon.com/checkout.js',
            'eu' => 'https://static-eu.payments-amazon.com/checkout.js',
            'jp' => 'https://static-fe.payments-amazon.com/checkout.js',
        ];

        return $scripts[$this->__get('region')];
    }

    /**
     * @param  string  $method
     * @param  string  $urlFragment
     * @param  string|array  $payload
     * @param  array|null  $headers
     * @param  array|null  $queryParams
     *
     * @throws \Exception
     */
    public function apiCall($method, $urlFragment, $payload, $headers = null, $queryParams = null): array
    {
        if ($this->fakeResponse !== null) {
            $response = [
                'status' => $this->fakeStatus,
                'method' => $method,
                'url' => $urlFragment,
                'headers' => $headers ?? [],
                'request' => is_array($payload) ? json_encode($payload) : $payload,
                'response' => json_encode($this->fakeResponse),
                'request_id' => Str::uuid()->toString(),
                'retries' => 0,
                'duration' => 0,
            ];

            $this->fakeResponse = null;

            return $response;
        }

        return parent::apiCall($method, $urlFragment, $payload, $headers, $queryParams);  // @codeCoverageIgnore
    }

    public function fake(?array $response = null, int $status = 200): void
    {
        $this->fakeResponse = $response;
        $this->fakeStatus = $status;
    }
}
