<?php

namespace SonLeu\SConnect\Api\Staff;

use SonLeu\SConnect\Models\ListDepartmentResponse;
use SonLeu\SConnect\ApiException;
use SonLeu\SConnect\ObjectSerializer;
use Exception;

class DepartmentApi extends BaseStaffApi
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|object|null|ListDepartmentResponse
     * @throws ApiException|Exception
     */
    public function listDeptChildren()
    {
        list($data, $statusCode, $headers) = $this->callApi('departments', 'GET', [
            'recursive' => 'children',
            'flatten' => 'true'
        ]);

        return ObjectSerializer::deserialize($data, ListDepartmentResponse::class);
    }
}
