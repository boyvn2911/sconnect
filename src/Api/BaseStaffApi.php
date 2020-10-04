<?php

namespace SonLeu\SConnect\Api;

use SonLeu\SConnect\ApiException;

abstract class BaseStaffApi extends BaseApi
{
    protected $token;

    public function __construct()
    {
        parent::__construct();

        $this->token = auth('sconnect')->token();
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
        $resourcePath = sprintf('%s/%s', 'staff', trim($resourcePath,'/'));

        $headers = array_merge($headers, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        return parent::callApi($resourcePath, $method, $queryParams, $httpBody, $headers);
    }
}
