<?php

namespace App\Models;

use App\Traits\Uuid;
use Laravel\Sanctum\PersonalAccessToken as Base;

class UserAccessToken extends  Base
{
    public $incrementing = false;

    use Uuid;
}
