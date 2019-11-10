<?php

namespace App\Models\Boss;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Boss extends Model
{
    /**
     * @var array $fillable
     */
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
