<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Group
{

    protected $table = 'groups';
    protected $defaultType = self::TYPE_DEPARTMENT;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class, 'parent_id');
    }

    public function departments(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
