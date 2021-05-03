<?php

namespace Modules\Security\Entities;

use App\Traits\Uuid;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Permission that can be applied to a role
 *
 */
class Permission extends Model
{
    use Uuid;

    const READ = 'read',
        READ_ANY = 'read_any',
        CREATE = 'create',
        UPDATE = 'update',
        DELETE = 'delete';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'resource_id',
        'resource',
        'role_alias',
        'user_id',
        'read',
        'create',
        'update',
        'delete'
    ];

    protected $casts = [
        'read' => 'boolean',
        'read_any' => 'boolean',
        'create' => 'boolean',
        'update' => 'boolean',
        'delete' => 'boolean',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_alias', 'alias');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
