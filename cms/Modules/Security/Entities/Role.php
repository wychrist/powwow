<?php

namespace Modules\Security\Entities;

use App\Models\Company;
use App\Traits\Uuid;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The responsibility (role) that can be apply to a user
 */
class Role extends Model
{
    use Uuid,
        SoftDeletes;

    const ROLE_SUPER_ADMIN = 'superadministrator',
        ROLE_ADMIN = 'administrator',
        ROLE_STAFF = 'staff',
        ROLE_CUSTOMER = 'customer',
        ROLE_GUEST = 'guest';


    protected $fillable = [
        'name',
        'alias',
        'company_id'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'role_alias', 'alias');
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'entity_roles');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)
            ->withTimestamps()
            ->with(['start', 'finish', 'priority', 'status']);
    }

    public function dashboard(): MorphToMany
    {
        return $this->morphedByMany(Dashboard::class, 'entity_roles');
    }

    public function setAliasAttribute($value)
    {
        if (!$this->alias || $this->alias == $value) {
            $this->attributes['alias'] = $value;
        }

    }

    protected static function booted()
    {
        static::creating(function ($role) {
            // generate alias from name
            $role->alias = strtolower(implode('', explode(' ', $role->name)));

            // make sure we do not have duplicates
            $existing = Role::where([
                'alias' => $role->alias,
                'company_id' => company()->id
            ])->first();

            if ($existing) {
                throw new \Exception("{$role->name}  already exist");
            }
        });

        // create dashboard
        static::created(function($role) {
            $dashboard = new Dashboard([
                'name' => ucfirst($role->name) . ' Dashboard'
            ]);
            $dashboard->save();
            $dashboard->roles()->attach($role);
        });
    }

    public static function getGenericRoles(): array
    {
        return [
            self::ROLE_SUPER_ADMIN => 'Super administrator',
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_STAFF => 'Staff',
            self::ROLE_CUSTOMER => 'customer'
        ];
    }
}
