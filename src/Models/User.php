<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\Auth\Models\User as Authenticatable;
use SonLeu\SConnect\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /** @var int */
    protected $id;

    /** @var string */
    protected $asgl_id;

    /** @var string */
    protected $full_name;

    /** @var string */
    protected $username;

    /** @var string */
    protected $email;

    /** @var Position[] */
    protected $positions;

    /** @var self[] */
    protected $staffs;

    /** @var self[] */
    protected $managers;

    /**
     * @var int $parent_id
     */
    protected $parent_id;

    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $typeMap = [
        'id' => 'integer',
        'asgl_id' => 'string',
        'full_name' => 'string',
        'username' => 'string',
        'email' => 'string',
        'positions' => Position::class . '[]',
        'staffs' => User::class . '[]',
        'managers' => User::class . '[]',
    ];

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'asgl_id' => 'asgl_id',
        'full_name' => 'full_name',
        'username' => 'username',
        'email' => 'email',
        'positions' => 'positions',
        'staffs' => User::class . '[]',
        'managers' => User::class . '[]',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'asgl_id' => 'setAsglId',
        'full_name' => 'setFullName',
        'username' => 'setUsername',
        'email' => 'setEmail',
        'positions' => 'setPositions',
        'staffs' => 'setStaffs',
        'managers' => 'setManagers',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'asgl_id' => 'getAsglId',
        'full_name' => 'getFullName',
        'username' => 'getUsername',
        'email' => 'getEmail',
        'positions' => 'getPositions',
        'staffs' => 'getStaffs',
        'managers' => 'getManagers',
    ];

    /**
     * User constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        unset($this->rememberTokenName);

        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->asgl_id = isset($data['asgl_id']) ? $data['asgl_id'] : null;
        $this->full_name = isset($data['full_name']) ? $data['full_name'] : null;
        $this->username = isset($data['username']) ? $data['username'] : null;
        $this->email = isset($data['email']) ? $data['email'] : null;
        $this->positions = isset($data['positions']) ? $data['positions'] : null;
        $this->staffs = isset($data['staffs']) ? $data['staffs'] : null;
        $this->managers = isset($data['managers']) ? $data['managers'] : null;

        if (config('s_connect.models.position')) {
            static::$typeMap['positions'] = config('s_connect.models.position') . '[]';
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAsglId(): string
    {
        return $this->asgl_id;
    }

    /**
     * @param string $asgl_id
     * @return User
     */
    public function setAsglId(string $asgl_id): User
    {
        $this->asgl_id = $asgl_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     * @return User
     */
    public function setFullName(string $full_name): User
    {
        $this->full_name = $full_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return Position[]
     */
    public function getPositions(): array
    {
        return $this->positions;
    }

    /**
     * @param Position[] $positions
     * @return User
     */
    public function setPositions(array $positions): User
    {
        $this->positions = $positions;
        return $this;
    }

    /**
     * Lấy ra chức vụ đầu tiên.
     *
     * TODO: update logic lấy chức vụ sau
     *
     * @return Position|mixed
     */
    public function getPosition()
    {
        return reset($this->positions);
    }

    /**
     * @return User[]
     */
    public function getStaffs(): array
    {
        return $this->staffs;
    }

    /**
     * @param User[] $staffs
     * @return User
     */
    public function setStaffs(array $staffs): User
    {
        $this->staffs = $staffs;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getManagers(): array
    {
        return $this->managers;
    }

    /**
     * @param User[] $managers
     * @return User
     */
    public function setManagers(array $managers): User
    {
        $this->managers = $managers;
        return $this;
    }
}
