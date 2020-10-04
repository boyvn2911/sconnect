<?php

namespace SonLeu\SConnect\Auth\Models;

use SonLeu\SConnect\AbstractModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends AbstractModel implements AuthenticatableContract
{
    use Authenticatable;
}
