<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemRarity extends Model
{
    /**
     * Relation with Item model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany('App\Models\Item\Item', 'item_rarity_id', 'id');
    }

    /**
     * Relation with Mission model.
     *
     * @return BelongsTo
     */
    public function mission(): BelongsTo
    {
        return $this->belongsTo('App\Models\Quest\Mission', 'id', 'reward_item_rarity');
    }

    /**
     * Relation with Quest model.
     *
     * @return BelongsTo
     */
    public function quest(): BelongsTo
    {
        return $this->belongsTo('App\Models\Quest\Quest', 'id', 'reward_item_rarity');
    }
}
