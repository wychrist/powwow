<?php

namespace App\Traits;

use App\Models\Company;
use Closure;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait CompanyTrait
{
    /**
     * Returns the user companies
     *
     * @param Closure $callback A call that can be use to alter the query
     *
     * @return Relation;
     */
    public function companies(Closure $callback = null): MorphToMany
    {
        $query = $this->morphToMany(Company::class, 'groupable');

        $query->withTimestamps()
            ->withPivot(['start', 'finish', 'priority', 'status']);

        if ($callback) {
            $callback($query);
        }

        return $query;
    }
}
