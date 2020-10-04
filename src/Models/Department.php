<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\AbstractModel;

class Department extends AbstractModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $system_code;

    /** @var string */
    protected $name;

    /** @var string */
    protected $short_code;

    /** @var int */
    protected $parent_id;

    /** @var DepartmentLevel */
    protected $level;

    /** @var Department[] */
    protected $children;


    /**
     * @var array
     */
    protected static $typeMap = [
        'id' => 'integer',
        'system_code' => 'string',
        'name' => 'string',
        'short_code' => 'string',
        'parent_id' => 'integer',
        'level' => DepartmentLevel::class,
        'children' => Department::class . '[]',
    ];

    protected static $attributeMap = [
        'id' => 'id',
        'system_code' => 'system_code',
        'name' => 'name',
        'short_code' => 'short_code',
        'parent_id' => 'parent_id',
        'level' => 'level',
        'children' => 'children',
    ];

    protected static $setters = [
        'id' => 'setId',
        'system_code' => 'setSystemCode',
        'name' => 'setName',
        'short_code' => 'setShortCode',
        'parent_id' => 'setParentId',
        'level' => 'setLevel',
        'children' => 'setChildren',
    ];

    protected static $getters = [
        'id' => 'getId',
        'system_code' => 'getSystemCode',
        'name' => 'getName',
        'short_code' => 'getShortCode',
        'parent_id' => 'getParentId',
        'level' => 'getLevel',
        'children' => 'getChildren',
    ];

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->id = isset($data['id']) ? $data['id'] : null;
            $this->system_code = isset($data['system_code']) ? $data['system_code'] : null;
            $this->name = isset($data['name']) ? $data['name'] : null;
            $this->short_code = isset($data['short_code']) ? $data['short_code'] : null;
            $this->parent_id = isset($data['parent_id']) ? $data['parent_id'] : null;
            $this->level = isset($data['level']) ? $data['level'] : null;
        }

        if (config('s_connect.models.department')) {
            static::$typeMap['children'] = config('s_connect.models.department') . '[]';
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
     * @return Department
     */
    public function setId(int $id): Department
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSystemCode(): string
    {
        return $this->system_code;
    }

    /**
     * @param string $system_code
     * @return Department
     */
    public function setSystemCode(string $system_code): Department
    {
        $this->system_code = $system_code;
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
     * @return Department
     */
    public function setName(string $name): Department
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortCode(): string
    {
        return $this->short_code;
    }

    /**
     * @param string $short_code
     * @return Department
     */
    public function setShortCode(string $short_code): Department
    {
        $this->short_code = $short_code;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     * @return Department
     */
    public function setParentId(int $parent_id): Department
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    /**
     * @return DepartmentLevel
     */
    public function getLevel(): DepartmentLevel
    {
        return $this->level;
    }

    /**
     * @param DepartmentLevel $level
     * @return Department
     */
    public function setLevel(DepartmentLevel $level): Department
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return Department[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Department[] $children
     * @return Department
     */
    public function setChildren(array $children)
    {
        $this->children = $children;
        return $this;
    }
}
