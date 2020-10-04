<?php

namespace SonLeu\SConnect;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class AbstractModel
 * @package Modules\Meeting\Services\Zoom\Model
 */
abstract class AbstractModel implements \JsonSerializable, Arrayable
{
    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $typeMap = [];

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [];

    /**
     * @return string[]
     */
    public static function typeMap()
    {
        return static::$typeMap;
    }

    /**
     * @return string[]
     */
    public static function attributeMap()
    {
        return static::$attributeMap;
    }

    /**
     * @return string[]
     */
    public static function setters()
    {
        return static::$setters;
    }

    /**
     * @return string[]
     */
    public static function getters()
    {
        return static::$getters;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function toArray()
    {
        return json_decode(json_encode($this), true);
    }
}
