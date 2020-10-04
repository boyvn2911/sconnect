<?php

namespace SonLeu\SConnect\Models;

use SonLeu\SConnect\AbstractModel;

class ListDepartmentData extends AbstractModel
{
    /** @var array */
    protected $departments;

    protected static $typeMap = [
        'departments' => Department::class . '[]',
    ];

    protected static $attributeMap = [
        'departments' => 'departments'
    ];

    protected static $getters = [
        'departments' => 'getDepartments'
    ];

    protected static $setters = [
        'departments' => 'setDepartments'
    ];

    /**
     * ListDepartmentData constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->departments = isset($data['departments']) ? $data['departments'] : null;
        }

        if (config('s_connect.models.department')) {
            static::$typeMap['departments'] = config('s_connect.models.department') . '[]';
        }
    }

    /**
     * @return Department[]
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * @param array $departments
     * @return ListDepartmentData
     */
    public function setDepartments($departments)
    {
        $this->departments = $departments;
        return $this;
    }
}
