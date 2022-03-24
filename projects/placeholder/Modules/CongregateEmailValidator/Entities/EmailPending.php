<?php

namespace Modules\CongregateEmailValidator\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class EmailPending extends Model
{
    use HasFactory;

    protected $table = 'cev_email_pending';

    protected $fillable = [
        'email',
        'callback',
        'payload',
        'expire_at'
    ];

    protected $casts = [
        'payload' => 'json',
        'callback' => 'json'
    ];

    protected static function booted()
    {
        static::creating(function($model){
            $date = Date::create();
            $date->addDays();
            $model->expire_at = $date;
            $model->token = Str::random(16);
        });
    }

    protected static function newFactory()
    {
        return \Modules\CongregateEmailValidator\Database\factories\EmailPendingFactory::new();
    }
}
