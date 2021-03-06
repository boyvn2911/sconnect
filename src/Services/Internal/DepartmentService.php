<?php

namespace SonLeu\SConnect\Services\Internal;

use Illuminate\Support\Facades\Cache;
use SonLeu\SConnect\ApiException;
use SonLeu\SConnect\Api\Internal\DepartmentApi;
use SonLeu\SConnect\Models\Department;
use Illuminate\Support\Collection;

class DepartmentService
{
    /**
     * @return Collection|Department[]
     * @throws ApiException
     */
    public function list()
    {
        if (Cache::has('listDept')) {
            return Cache::get('listDept');
        }

        $response = (new DepartmentApi())->list();

        $departments = collect($response->getData()->getDepartments());

        Cache::put('listDept', $departments, config('s_connect.cache.ttl'));

        return $departments;
    }

    /**
     * @return Collection|Department[]
     * @throws ApiException
     */
    public function listTree()
    {
        if (Cache::has('listDeptTree')) {
            return Cache::get('listDeptTree');
        }

        $response = (new DepartmentApi())->listTree();

        $departments = collect($response->getData()->getDepartments());

        Cache::put('listDeptTree', $departments, config('s_connect.cache.ttl'));

        return $departments;
    }

    /**
     * @param $level_id
     * @return \Illuminate\Support\Collection
     * @throws ApiException
     */
    public function listByLevel($level_id)
    {
        return $this->list()->filter(function (Department $department) use ($level_id) {
            return $department->getLevel()->getId() == $level_id;
        });
    }

    /**
     * @param $department_id
     * @return Department|null
     * @throws ApiException|\Exception
     */
    public function getById($department_id)
    {
        $departments = $this->list();

        return $departments->filter(function (Department $department) use ($department_id) {
            return $department->getId() == $department_id;
        })->first();
    }

    /**
     * @param int $parent_id
     * @return \Illuminate\Support\Collection | string
     * @throws ApiException
     */
    public function listByParentId($parent_id)
    {
        $departments = $this->list();

        return $departments->filter(function (Department $department) use ($parent_id) {
            return $department->getParentId() == $parent_id;
        });
    }
}
