<?php

namespace Modules\People\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Family extends Model
{
    use Uuid;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name'
    ];

    public function members()
    {
        return $this->hasMany(FamilyMember::class)->with('person');
    }
}
