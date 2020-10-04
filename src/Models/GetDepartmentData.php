<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\AbstractModel;

class GetDepartmentData extends AbstractModel
{
    /** @var array */
    protected $department;

    protected static $typeMap = [
        'department' => Department::class
    ];

    protected static $attributeMap = [
        'department' => 'department'
    ];

    protected static $getters = [
        'department' => 'getDepartment'
    ];

    protected static $setters = [
        'department' => 'setDepartment'
    ];

    /**
     * GetUserData constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->department = isset($data['department']) ? $data['department'] : null;
        }

        if (config('s_connect.models.department')) {
            static::$typeMap['department'] = config('s_connect.models.department');
        }
    }

    /**
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param array $department
     * @return GetDepartmentData
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }
}
