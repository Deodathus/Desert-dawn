<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed reward_gold
 * @property mixed reward_exp
 */
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

    public function items()
    {
        return $this->hasMany('App\Models\Item', 'id', 'reward_item');
    }
}
