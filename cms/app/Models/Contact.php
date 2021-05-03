<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Security\Contracts\SecureInterface;

class Contact extends Model implements SecureInterface
{
    use Uuid,
        SoftDeletes;

    const TYPE_EMAIL = 'email',
        TYPE_PHONE = 'phone',
        TYPE_MOBILE = 'mobile',
        TYPE_SKYPE = 'skype';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'contact',
        'type'
    ];

    public static function getHumanDescription(): string
    {
        return __('resource.contact_description');
    }

    public static function getHumanName(): string
    {
        return 'contact';
    }
}
