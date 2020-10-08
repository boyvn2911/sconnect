<?php

namespace SonLeu\SConnect\Api\Internal;

use SonLeu\SConnect\Models\GetDepartmentResponse;
use SonLeu\SConnect\Models\ListDepartmentResponse;
use SonLeu\SConnect\ApiException;
use SonLeu\SConnect\ObjectSerializer;
use Exception;

class DepartmentApi extends BaseInternalApi
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|object|null|ListDepartmentResponse
     * @throws ApiException|Exception
     */
    public function list()
    {
        list($data, $statusCode, $headers) = $this->callApi('departments', 'GET', [
            'pagination' => 'false',
        ]);

        return ObjectSerializer::deserialize($data, ListDepartmentResponse::class);
    }

    /**
     * @return array|object|null|ListDepartmentResponse
     * @throws ApiException|Exception
     */
    public function listTree()
    {
        list($data, $statusCode, $headers) = $this->callApi('departments', 'GET', [
            'pagination' => 'false',
            'search' => 'level_id:2',
            'recursive' => 'true'
        ]);

        return ObjectSerializer::deserialize($data, ListDepartmentResponse::class);
    }

    /**
     * @param int $id
     * @return array|object|null|GetDepartmentResponse
     * @throws ApiException|Exception
     */
    public function get($id)
    {
        list($data, $statusCode, $headers) = $this->callApi('departments/' . $id, 'GET');

        return ObjectSerializer::deserialize($data, GetDepartmentResponse::class);
    }
}
