<?php

namespace Modules\CongregateSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'name',
        'value'
    ];

    protected $casts = [
        'value' => 'json'
    ];

    protected static function newFactory()
    {
        return \Modules\CongregateSetting\Database\factories\SettingFactory::new();
    }
}
