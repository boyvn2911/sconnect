<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\AbstractModel;

class GetUserData extends AbstractModel
{
    /** @var array */
    protected $user;

    protected static $typeMap = [
        'user' => User::class,
    ];

    protected static $attributeMap = [
        'user' => 'user'
    ];

    protected static $getters = [
        'user' => 'getUser'
    ];

    protected static $setters = [
        'user' => 'setUser'
    ];

    /**
     * GetUserData constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->user = isset($data['user']) ? $data['user'] : null;
        }

        if (config('s_connect.models.user')) {
            static::$typeMap['user'] = config('s_connect.models.user');
        }
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param array $user
     * @return GetUserData
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
