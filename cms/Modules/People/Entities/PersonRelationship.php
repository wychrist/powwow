<?php

namespace Modules\People\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\People\Contracts\RelationshipInterface;

class PersonRelationship
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
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function relation()
    {
        return $this->belongsTo(Person::class, 'relation_id');
    }
}
