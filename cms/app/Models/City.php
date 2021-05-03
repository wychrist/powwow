<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Security\Contracts\SecureInterface;

class City extends Model implements SecureInterface
{
    use Uuid,
    SoftDeletes,
    MetadataTrait;

   public $incrementing = false;
   protected $keyType = 'string';

   public function country(): BelongsTo
   {
       return $this->belongsTo(Country::class);
   }

   public function state(): BelongsTo
   {
       return $this->belongsTo(State::class);
   }

   public static function getHumanName(): string
   {
       return 'city';
   }

   public static function getHumanDescription(): string
   {
       return __('resource.city_description');
   }
}
