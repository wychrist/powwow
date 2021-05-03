<?php

namespace App\Models;

use App\Traits\Groupable;
use App\Traits\MetadataTrait;
use App\Traits\Uuid;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use Uuid,
        SoftDeletes,
        MetadataTrait,
        Groupable;

    const TYPE_COMPANY = 'company',
        TYPE_SUBSIDIARY = 'subsidiary',
        TYPE_DEPARTMENT = 'department';

    const STATUS_ACTIVE = 'active',
        STATUS_INACTIVE = 'inactive';

    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'type',
        'parent_id'
    ];

    protected $defaultType;


    public function __construct(array $attributes = [])
    {
        if ($this->defaultType) {
            $attributes['type'] = $this->defaultType;
        }

        parent::__construct($attributes);
    }

    public function newQuery()
    {
        $query = parent::newQuery();
        if ($this->defaultType) {
            $query->where('type', $this->defaultType);
        }

        return $query;
    }

    public function children(string $type = null, Closure $callback = null): HasMany
    {
        if ($type) {
            $query =  $this->hasMany($type, 'parent_id');
        } else {
            $query = $this->hasMany(static::class, 'parent_id');
        }

        if ($callback) {
            $callback($query);
        }

        return $query;
    }

    public function root(string $type = null): BelongsTo
    {
        if ($type) {
            return  $this->belongsTo($type, 'parent_id');
        } else {
            return $this->belongsTo(self::class, 'parent_id');
        }
    }

    public function setAliasAttribute($value)
    {
        if (!$this->alias || $this->alias == $value) {
            $this->attributes['alias'] = $value;
        }
    }


    protected static function booted()
    {
        static::creating(function ($group) {
            // generate alias from name
            $group->alias = strtolower(implode('', explode(' ', $group->name)));

            // make sure we do not have duplicates
            $existing = Group::where([
                'alias' => $group->alias,
                'type'  => $group->type,
            ])->first();

            if ($existing) {
                throw new \Exception("{$group->name} of the type {$group->type} already exist");
            }

            $ignore = [
                self::TYPE_COMPANY,
                self::TYPE_SUBSIDIARY,
            ];

            // assign to company automatically
            if (!in_array($group->type, $ignore)) {
                company()->groups()->attach($group);
            }
        });
    }
}
