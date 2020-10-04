<?php

namespace SonLeu\SConnect\Auth\Guards;

use SonLeu\SConnect\ObjectSerializer;
use SonLeu\SConnect\Api\LoginApi;
use SonLeu\SConnect\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * Class SConnectGuard
 */
class SConnectGuard implements Guard
{
    /**
     * @var User|null
     */
    protected $user;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var Request
     */
    protected $request;

    protected $application_access_permissions;

    /**
     * OpenAPIGuard constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;

        return $this;
    }

    public function setApplicationAccessPermissions($application_access_permissions)
    {
        $this->application_access_permissions = $application_access_permissions;
        return $this;
    }

    public function unsetUser()
    {
        $this->user = null;

        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    public function unsetToken()
    {
        $this->token = null;

        return $this;
    }

    /**
     * @return User|Authenticatable|null
     */
    public function user()
    {
        return $this->user ?? session()->get($this->getLoginName());
    }

    public function id()
    {
        return $this->user->getId();
    }

    public function token()
    {
        return $this->token ?? session()->get($this->getTokenName());
    }

    public function check()
    {
        return (bool)$this->user();
    }

    public function guest()
    {
        return !$this->check();
    }

    /**
     * @param array $credentials
     * @return bool|void
     */
    public function validate(array $credentials = [])
    {
        throw new \BadMethodCallException('Unexpected method call');
    }

    /**
     * @param array $credentials
     * @return bool
     */
    public function attempt(array $credentials = [])
    {
        try {
            $param = [
                'login' => $credentials['username'],
                'password' => $credentials['password'],
            ];

            $data = (new LoginApi())->login($param);

            /** @var User $user */
            $user = ObjectSerializer::deserialize($data->user, config('s_connect.models.user'));
            $token = $data->token;

            $this->login($user, $token);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param User $user
     * @param null $token
     * @param null $application_access_permissions
     */
    public function login($user, $token = null, $application_access_permissions = null)
    {
        $this->setUser($user);
        $this->setToken($token);
        $this->setApplicationAccessPermissions($application_access_permissions);

        $this->updateSession();
    }

    public function logout()
    {
        $this->unsetUser();
        $this->unsetToken();
        $this->forgetSession();

        session()->flush();
    }

    /**
     * Get a unique identifier for the auth session value.
     *
     * @return string
     */
    public function getLoginName()
    {
        return 'login_' . sha1(static::class);
    }

    /**
     * Get a unique identifier for the auth session value.
     *
     * @return string
     */
    public function getTokenName()
    {
        return 'token_' . sha1(static::class);
    }

    protected function updateSession()
    {
        session()->put($this->getLoginName(), $this->user);
        session()->put($this->getTokenName(), $this->token);
    }

    protected function forgetSession()
    {
        session()->forget($this->getLoginName());
        session()->forget($this->getTokenName());
    }
}
