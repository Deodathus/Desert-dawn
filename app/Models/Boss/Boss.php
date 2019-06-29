<?php

namespace App\Models\Boss;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Relation with Item model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany('App\Models\Item\Item', 'id', 'reward_item');
    }

    /**
     * Raletion with ItemRarity model.
     *
     * @return HasMany
     */
    public function itemRarity(): HasMany
    {
        return $this->hasMany('App\Models\Item\ItemRarity', 'id', 'reward_item_rarity');
    }
}
