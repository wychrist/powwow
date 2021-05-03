<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Security\Contracts\SecureInterface;

class State extends Model implements SecureInterface
{
    use Uuid,
    MetadataTrait,
    SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';


    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }


    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }


    public static function getHumanName(): string
    {
        return 'state';
    }

    public static function getHumanDescription(): string
    {
        return __('resource.state_description');
    }
}
