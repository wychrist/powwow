<?php

namespace Modules\Security\Entities;

use App\Models\Group;
use App\Traits\ModelExtendTrait;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Dashboard extends Group
{
    use ModelExtendTrait;

    const TYPE_DASHBOARD = 'dashboard';

    protected $defaultType = self::TYPE_DASHBOARD;

    public function roles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'entity_roles')->where('company_id', company()->id);
    }
}
