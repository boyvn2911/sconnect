<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\AbstractModel;

class PositionLevel extends AbstractModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /**
     * PositionLevel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->name = isset($data['name']) ? $data['name'] : null;
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
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
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
     * @return PositionLevel
     */
    public function setId(int $id): PositionLevel
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
     * @return PositionLevel
     */
    public function setName(string $name): PositionLevel
    {
        $this->name = $name;
        return $this;
    }
}
