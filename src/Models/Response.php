<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\AbstractModel;

abstract class Response extends AbstractModel
{
    /** @var bool */
    protected $success;

    /** @var string */
    protected $error_code;

    /** @var string */
    protected $message;

    /** @var array */
    protected $data;

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->success = isset($data['success']) ? $data['success'] : null;
            $this->error_code = isset($data['error_code']) ? $data['error_code'] : null;
            $this->message = isset($data['message']) ? $data['message'] : null;
            $this->data = isset($data['data']) ? $data['data'] : null;
        }
    }

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return Response
     */
    public function setSuccess(bool $success): Response
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->error_code;
    }

    /**
     * @param string $error_code
     * @return Response
     */
    public function setErrorCode(string $error_code): Response
    {
        $this->error_code = $error_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Response
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     * @return Response
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
