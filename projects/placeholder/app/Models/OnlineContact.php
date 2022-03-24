<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'type',
        'data',
    ];

    protected $casts = [
        'data' => 'json'
    ];

}
