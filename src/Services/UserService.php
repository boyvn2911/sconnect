<?php

namespace SonLeu\SConnect\Services;

use SonLeu\SConnect\ApiException;
use SonLeu\SConnect\Api\UserApi;
use SonLeu\SConnect\Models\ListUserResponse;
use SonLeu\SConnect\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    /** @var User $user_login */
    private $user_login;

    public function __construct()
    {
        $this->user_login = auth('sconnect')->user();
    }

    /**
     * @return Collection|User[]
     * @throws ApiException
     */
    public function list()
    {
        if (session()->has('listUsers')) {
            return session()->get('listUsers');
        }

        $response = (new UserApi())->list();

        $users = collect($response->getData()->getUsers());

        session()->put('listUsers', $users);

        return $users;
    }

    /**
     * @param $department_id
     * @return \Illuminate\Support\Collection
     * @throws ApiException
     */
    public function listByDept($department_id)
    {
        $users = $this->list();

        return $users->filter(function (User $user) use ($department_id) {
            $position = $user->getPosition();

            if (!$position)
                return false;

            return $position->getDepartment()->getId() == $department_id;
        });
    }

    /**
     * @param int $user_id
     * @return User|null
     * @throws ApiException|\Exception
     */
    public function getById($user_id)
    {
        $users = $this->list();

        return $users->filter(function (User $user) use ($user_id) {
            return $user->getId() == $user_id;
        })->first();
    }

    /**
     * @param string $asgl_id
     * @return User|null
     * @throws ApiException
     */
    public function getByAsglId($asgl_id)
    {
        $users = $this->list();

        return $users->filter(function (User $user) use ($asgl_id) {
            return strcasecmp($user->getAsglId(), $asgl_id) == 0;
        })->first();
    }

    /**
     * @param User|int $user
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listDirectStaffsOfUser($user)
    {
        $id = $user instanceof User ? $user->getId() : $user;

        /** @var ListUserResponse $response */
        $response = (new UserApi())->listDirectStaffs($id);

        return collect($response->getData()->getUsers());
    }

    /**
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listDirectStaffsOfCurrentUser()
    {
        if (session()->has('listDirectStaffs')) {
            return session()->get('listDirectStaffs');
        }

        /** @var User $user */
        $user = auth('sconnect')->user();

        $direct_staffs = $this->listDirectStaffsOfUser($user);

        session()->put('listDirectStaffs', $direct_staffs);

        return $direct_staffs;
    }

    /**
     * @param User|int $user
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listStaffsOfUser($user)
    {
        $id = $user instanceof User ? $user->getId() : $user;

        /** @var ListUserResponse $response */
        $response = (new UserApi())->listStaffs($id);

        return collect($response->getData()->getUsers());
    }

    /**
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listStaffsOfCurrentUser()
    {
        if (session()->has('listStaffs')) {
            return session()->get('listStaffs');
        }

        /** @var User $user */
        $user = auth('sconnect')->user();

        $staffs = $this->listStaffsOfUser($user);

        session()->put('listStaffs', $staffs);

        return $staffs;
    }

    /**
     * @param User|int $user
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listManagersOfUser($user)
    {
        $id = $user instanceof User ? $user->getId() : $user;

        /** @var ListUserResponse $response */
        $response = (new UserApi())->listManagers($id);

        return collect($response->getData()->getUsers());
    }

    /**
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listManagersOfCurrentUser()
    {
        if (session()->has('listManagers')) {
            return session()->get('listManagers');
        }

        /** @var User $user */
        $user = auth('sconnect')->user();

        $managers = $this->listManagersOfUser($user);

        session()->put('listManagers', $managers);

        return $managers;
    }

    /**
     * @param User|int $user
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listDirectManagersOfUser($user)
    {
        $id = $user instanceof User ? $user->getId() : $user;

        /** @var ListUserResponse $response */
        $response = (new UserApi())->listDirectManagers($id);

        return collect($response->getData()->getUsers());
    }

    /**
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listDirectManagersOfCurrentUser()
    {
        if (session()->has('listDirectManagers')) {
            return session()->get('listDirectManagers');
        }

        /** @var User $user */
        $user = auth('sconnect')->user();

        $direct_managers = $this->listDirectManagersOfUser($user);

        session()->put('listDirectManagers', $direct_managers);

        return $direct_managers;
    }
}
