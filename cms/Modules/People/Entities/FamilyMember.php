<?php

namespace Modules\People\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\People\Contracts\RelationshipInterface;

class FamilyMember
 extends Model
 implements RelationshipInterface
{
    use Uuid,
    SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable = [
        'role'
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
