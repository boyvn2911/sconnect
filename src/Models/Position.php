<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\AbstractModel;

class Position extends AbstractModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var PositionLevel */
    protected $level;

    /** @var Department */
    protected $department;

    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $typeMap = [
        'id' => 'integer',
        'name' => 'string',
        'level' => PositionLevel::class,
        'department' => Department::class,
    ];

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'name' => 'name',
        'level' => 'level',
        'department' => 'department',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'level' => 'setLevel',
        'department' => 'setDepartment',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'level' => 'getLevel',
        'department' => 'getDepartment',
    ];

    /**
     * Position constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->id = isset($data['id']) ? $data['id'] : null;
            $this->name = isset($data['name']) ? $data['name'] : null;
            $this->level = isset($data['level']) ? $data['level'] : null;
            $this->department = isset($data['department']) ? $data['department'] : null;
        }

        if (config('s_connect.models.department')) {
            static::$typeMap['department'] = config('s_connect.models.department');
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
     * @return Position
     */
    public function setId(int $id): Position
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Position
     */
    public function setName(string $name): Position
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return PositionLevel
     */
    public function getLevel(): PositionLevel
    {
        return $this->level;
    }

    /**
     * @param PositionLevel $level
     * @return Position
     */
    public function setLevel(PositionLevel $level): Position
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return Department
     */
    public function getDepartment(): Department
    {
        return $this->department;
    }

    /**
     * @param Department $department
     * @return Position
     */
    public function setDepartment(Department $department): Position
    {
        $this->department = $department;
        return $this;
    }
}
