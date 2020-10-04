<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\AbstractModel;

class DepartmentLevel extends AbstractModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->id = isset($data['id']) ? $data['id'] : null;
            $this->name = isset($data['name']) ? $data['name'] : null;
        }
    }

    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $typeMap = [
        'id' => 'integer',
        'name' => 'string',
    ];

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'name' => 'name',
    ];

    /**
     * @var array
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
    ];

    /**
     * @var array
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return DepartmentLevel
     */
    public function setId(int $id): DepartmentLevel
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
     * @return DepartmentLevel
     */
    public function setName(string $name): DepartmentLevel
    {
        $this->name = $name;
        return $this;
    }
}
