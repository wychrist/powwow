<?php

namespace App\Traits;
use Closure;
use App\Models\Group;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Groupable
{
    /**
     * Returns the user groups
     *
     * @param string $type the type of groups to return. Default all
     * @param Closure $callback A call that can be use to alter the query
     *
     * @return Relation;
     */
    public function groups(string $type = null, Closure $callback = null): MorphToMany
    {
        if ($type) {
            $query = $this->morphToMany(Group::class, 'groupable')
            ->where('type', $type);
        } else {
            $query = $this->morphToMany(Group::class, 'groupable');
        }

        $query->withTimestamps()
            ->with(['start', 'finish', 'priority', 'status']);

        if ($callback) {
            $callback($query);
        }

        return $query;
    }
}
