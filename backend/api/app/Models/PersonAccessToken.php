<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\CPBase\Traits\Uuid;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory, Uuid;
}
