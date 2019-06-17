<?php

namespace App\Models\Quest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mission extends Model
{
    protected $fillable = [
        'name',
        'description',
        'reward_gold',
        'reward_exp',
        'reward_gems',
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
     * @return BelongsTo
     */
    public function quest(): BelongsTo
    {
        return $this->belongsTo('App\Models\Quest\Quest', 'id', 'quest_id');
    }
}
