<?php

namespace App\Models\Quest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quest extends Model
{
    protected $fillable = [
        'name',
        'reward_gold',
        'reward_gems',
        'reward_exp',
        'done',
    ];

    /**
     * @return HasOne
     */
    public function itemRarity(): HasOne
    {
        return $this->hasOne('App\Models\Item\ItemRarity', 'id', 'reward_item_rarity');
    }

    /**
     * @return HasOne
     */
    public function item(): HasOne
    {
        return $this->hasOne('App\Models\Item\Item', 'id', 'reward_item');
    }

    /**
     * @return HasMany
     */
    public function mission(): HasMany
    {
        return $this->hasMany('App\Models\Quest\Mission', 'quest_id', 'id');
    }
}
