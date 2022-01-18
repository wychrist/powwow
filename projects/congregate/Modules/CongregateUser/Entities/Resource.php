<?php

namespace Modules\CongregateUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\CongregateUser\Database\factories\ResourceFactory::new();
    }
}
