<?php

namespace SonLeu\SConnect\Api\Internal;

use SonLeu\SConnect\Api\BaseApi;
use SonLeu\SConnect\ApiException;

abstract class BaseInternalApi extends BaseApi
{
    protected $api_key;

    public function __construct()
    {
        parent::__construct();

        $this->api_key = config('s_connect.api_key');
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
        $resourcePath = sprintf('%s/%s', 'internal', trim($resourcePath,'/'));

        $headers = array_merge($headers, [
            'x-api-key' => $this->api_key,
        ]);

        return parent::callApi($resourcePath, $method, $queryParams, $httpBody, $headers);
    }
}
