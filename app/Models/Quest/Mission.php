<?php

namespace App\Models\Quest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mission extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'description',
        'reward_gold',
        'reward_exp',
        'reward_gems',
        'done'
    ];

    /**
     * Relation with ItemRarity model.
     *
     * @return HasOne
     */
    public function itemRarity(): HasOne
    {
        return $this->hasOne('App\Models\Item\ItemRarity', 'id', 'reward_item_rarity');
    }

    /**
     * Relation with Item model.
     *
     * @return HasOne
     */
    public function item(): HasOne
    {
        return $this->hasOne('App\Models\Item\Item', 'id', 'reward_item');
    }

    /**
     * Relation with Quest model.
     *
     * @return BelongsTo
     */
    public function quest(): BelongsTo
    {
        return $this->belongsTo('App\Models\Quest\Quest', 'id', 'quest_id');
    }
}
