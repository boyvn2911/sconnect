<?php

namespace SonLeu\SConnect\Api;

use SonLeu\SConnect\ApiException;

/**
 * Class LoginApi
 * @package SonLeu\SConnect\Api
 */
class LoginApi extends BaseApi
{
    /**
     * @param $credentials
     * @return mixed
     * @throws ApiException
     */
    public function login($credentials)
    {
        list($data, $statusCode, $headers) = $this->callApi('auth/login', 'POST', $credentials);

        return $data->data;
    }

    /**
     * @param $asgl_id
     * @return mixed
     * @throws ApiException
     */
    public function resetPassword($asgl_id)
    {
        $params = [
            'login' => $asgl_id,
        ];

        list($data, $statusCode, $headers) = $this->callApi('auth/password/email', 'POST', $params);

        return $data;
    }
}
