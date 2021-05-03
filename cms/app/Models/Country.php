<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Security\Contracts\SecureInterface;

class Country extends Model implements SecureInterface
{
    use Uuid,
    MetadataTrait,
    SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public static function getHumanName(): string
    {
        return 'country';
    }

    public static function getHumanDescription(): string
    {
        return __('resource.country_description');
    }
}
