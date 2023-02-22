<?php

declare(strict_types=1);

namespace Sunaoka\AmazonPay\Laravel;

use Exception;
use Illuminate\Support\Str;

class Client extends \Amazon\Pay\API\Client
{
    /**
     * @var array|null
     */
    protected $fakeResponse = null;

    /**
     * @var int
     */
    protected $fakeStatus = 200;

    /**
     * Get Amazon Pay script URL
     *
     * @return string
     *
     * @throws Exception
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
     * @param string       $method
     * @param string       $urlFragment
     * @param string|array $payload
     * @param array|null   $headers
     * @param array|null   $queryParams
     *
     * @return array
     *
     * @throws Exception
     */
    public function apiCall($method, $urlFragment, $payload, $headers = null, $queryParams = null): array
    {
        if ($this->fakeResponse !== null) {
            $response = [
                'status'     => $this->fakeStatus,
                'method'     => $method,
                'url'        => $urlFragment,
                'headers'    => $headers ?? [],
                'request'    => is_array($payload) ? json_encode($payload) : $payload,
                'response'   => json_encode($this->fakeResponse),
                'request_id' => Str::uuid()->toString(),
                'retries'    => 0,
                'duration'   => 0,
            ];

            $this->fakeResponse = null;

            return $response;
        }

        return parent::apiCall($method, $urlFragment, $payload, $headers, $queryParams);
    }

    /**
     * @param array|null $response
     * @param int        $status
     *
     * @return void
     */
    public function fake(array $response = null, int $status = 200): void
    {
        $this->fakeResponse = $response;
        $this->fakeStatus = $status;
    }
}
