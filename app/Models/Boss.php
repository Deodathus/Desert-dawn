<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boss extends Model
{
    protected $fillable = [
        'name',
        'hp',
        'armor',
        'reward_gold',
        'reward_exp',
        'reward_item'
    ];
}
