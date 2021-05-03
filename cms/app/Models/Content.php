<?php

namespace App\Models;

use App\Traits\Groupable;
use App\Traits\MetadataTrait;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Generic content model
 *
 * Most entity will extend this class
 */
class Content extends Model
{
    use Uuid,
        SoftDeletes,
        MetadataTrait,
        Groupable;

    protected $with = [
        'metadata'
    ];


    public $incrementing = false;
    protected $keyType = 'string';

    public function company(): MorphToMany
    {
        return $this->groups(Group::TYPE_COMPANY);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $existing = static::where([
                'name' => $model->name,
                'type' => $model->type
            ])->whereHas('company', function ($query) {
                $query->where('group_id', company()->id);
            })->first();

            if ($existing) {
                $companyName = company()->name;
                throw new \Exception("{$model->name} of the type {$model->type} already exitst in company {$companyName}");
            }
        });
        static::saved(function ($model) {
            $model->groups(Group::TYPE_COMPANY)->syncWithoutDetaching(company());
        });
    }


    public function __get($key)
    {

        if (strpos($key, 'meta_') === 0) {
            return $this->getMetadataByName(str_replace('meta_', '', $key));
        } else {
            return parent::__get($key);
        }
    }

    public function __set($key, $value)
    {

        if (strpos($key, 'meta_') === 0) {
            return $this->setMetadata(str_replace('meta_', '', $key), $value);
        } else {
            return parent::__set($key, $value);
        }
    }
}
