<?php

namespace App\Models;

use App\Traits\ModelExtendTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subsidiary extends Group
{
    use ModelExtendTrait;

    protected $defaultType = self::TYPE_SUBSIDIARY;


    public function company()
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

}
