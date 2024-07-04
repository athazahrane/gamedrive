<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = ['email', 'name_game', 'no_tlp', 'name', 'username', 'options'];

    protected $casts = [
        'options' => 'array',
    ];
}