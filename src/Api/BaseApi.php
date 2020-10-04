<?php

namespace SonLeu\SConnect\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use SonLeu\SConnect\ApiException;

abstract class BaseApi
{
    protected $base_uri;

    public function __construct()
    {
        $this->base_uri = trim(config('s_connect.root_url'), '/') . '/';
    }

    /**
     * @param $resourcePath
     * @param $method
     * @param array $queryParams
     * @param array $httpBody
     * @param array $headers
     * @return array
     * @throws ApiException
     */
    protected function callApi($resourcePath, $method, $queryParams = [], $httpBody = [], $headers = [])
    {
        $options = [
            'headers' => array_merge($headers, [
                'Content-Type' => 'application/json',
            ]),
            'query' => $queryParams,
            'json' => $httpBody,
        ];

        $client = new Client(['base_uri' => $this->base_uri]);

        try {
            $response = $client->request($method, $resourcePath, $options);
        } catch (RequestException $e) {
            throw new ApiException(
                "[{$e->getCode()}] {$e->getMessage()}",
                $e->getCode(),
                $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
            );
        }

        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode > 299) {
            throw new ApiException(
                sprintf(
                    '[%d] Error connecting to the API (%s)',
                    $statusCode,
                    trim($this->base_uri, '/') . '/' . trim($resourcePath, '/')
                ),
                $statusCode,
                $response->getHeaders(),
                $response->getBody()
            );
        }

        return [json_decode($response->getBody()), $statusCode, $response->getHeaders()];
    }
}
