<?php

namespace SonLeu\SConnect\Api;

use SonLeu\SConnect\Api\Internal\BaseInternalApi;
use SonLeu\SConnect\ApiException;
use SonLeu\SConnect\AbstractModel;
use SonLeu\SConnect\ObjectSerializer;
use SonLeu\SConnect\Models\GetUserResponse;
use SonLeu\SConnect\Models\ListUserResponse;

class UserApi extends BaseInternalApi
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|object|null|ListUserResponse
     * @throws ApiException|\Exception
     */
    public function list()
    {
        list($data, $statusCode, $headers) = $this->callApi('users', 'GET', [
            'pagination' => 'false',
        ]);

        return ObjectSerializer::deserialize($data, ListUserResponse::class);
    }

    /**
     * @param int $id
     * @return array|object|null|GetUserResponse
     * @throws ApiException|\Exception
     */
    public function get($id)
    {
        list($data, $statusCode, $headers) = $this->callApi('users/' . $id, 'GET');

        return ObjectSerializer::deserialize($data, GetUserResponse::class);
    }

    /**
     * Lấy về danh sách nhân viên của người dùng hiện tại cả trực tiếp lẫn gián tiếp
     *
     * @param $id
     * @return AbstractModel|array|\DateTime|object|\SplFileObject|null
     * @throws ApiException|\Exception
     */
    public function listDirectStaffs($id) {
        list($data, $statusCode, $headers) = $this->callApi('users/'.$id.'/staffs', 'GET');

        return ObjectSerializer::deserialize($data, ListUserResponse::class);
    }

    /**
     * Lấy về danh sách nhân viên trực tiếp của người dùng hiện tại
     *
     * @param $id
     * @return AbstractModel|array|\DateTime|object|\SplFileObject|null
     * @throws ApiException|\Exception
     */
    public function listStaffs($id) {
        list($data, $statusCode, $headers) = $this->callApi('users/'.$id.'/staffs/all', 'GET');

        return ObjectSerializer::deserialize($data, ListUserResponse::class);
    }

    /**
     * Lấy về danh sách quản lý của người dùng hiện tại cả trực tiếp lẫn gián tiếp
     *
     * @param $id
     * @return AbstractModel|array|\DateTime|object|\SplFileObject|null
     * @throws ApiException|\Exception
     */
    public function listManagers($id) {
        list($data, $statusCode, $headers) = $this->callApi('users/'.$id.'/managers/all', 'GET');

        return ObjectSerializer::deserialize($data, ListUserResponse::class);
    }

    /**
     * Lấy về danh sách quản lý trực tiếp của người dùng hiện tại
     *
     * @param $id
     * @return AbstractModel|array|\DateTime|object|\SplFileObject|null
     * @throws ApiException|\Exception
     */
    public function listDirectManagers($id) {
        list($data, $statusCode, $headers) = $this->callApi('users/'.$id.'/managers', 'GET');

        return ObjectSerializer::deserialize($data, ListUserResponse::class);
    }
}
