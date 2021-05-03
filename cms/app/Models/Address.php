<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Security\Contracts\SecureInterface;

class Address extends Model implements SecureInterface
{
    use Uuid,
    SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [];


    public static function getHumanName(): string
    {
        return 'Address';
    }

    public static function getHumanDescription(): string
    {
       return __('resource.address_description');
    }
}
