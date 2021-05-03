<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\People\Entities\Person;
use Modules\Security\Contracts\SecureInterface;
use Modules\Security\Traits\PermissionTrait;
use Modules\Security\Traits\RoleTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements SecureInterface
{
    use Notifiable,
        RoleTrait,
        Uuid,
        PermissionTrait,
        MetadataTrait,
        HasApiTokens;

    // we are not using auto increment primary key
    public $incrementing = false;
    protected $keyType = 'string';

    protected $with = [
        'person',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'force_password_reset'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
        $this->attributes['password_updated_at'] = now()->format('Y-m-d');
    }

    public function getCurrentCompany(): string
    {
        $defaultAlias = env('DEFAULT_COMPANY_ALIAS', 'bulbul');
        return $this->getMetadataByName('_current_company', $defaultAlias);
    }

    public function setCurrentCompany(string $alias): self
    {
        return $this->setMetadataText('_current_company', $alias);
    }

    public function getActiveRole(): ?string
    {
        $role = $this->getMetadataByName('_active_role');
        if(!$role) {
            $first = $this->roles->first();
            if($first) {
                $role = $first->alias;
            }
        }

        return $role;
    }

    public function setActiveRole(string $alias): self
    {
        return $this->setMetadataText('_active_role', $alias, true);
    }

    public static function getHumanName(): string
    {
        return 'user';
    }

    public static function getHumanDescription(): string
    {
        return __('resource.user_description');
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->api_token = $user->createToken('BulbulApp')->plainTextToken;
            $user->save();
        });
    }
}
