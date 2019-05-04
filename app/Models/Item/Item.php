<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    protected $fillable = [
        'item_rarity_id',
        'name',
        'required_level',
        'active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rarity(): BelongsTo
    {
        return $this->belongsTo('App\Models\Item\ItemRarity', 'item_rarity_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User\User')->withPivot('active');
    }

    /**
     * @return BelongsTo
     */
    public function boss(): BelongsTo
    {
        return $this->belongsTo('App\Models\Boss\Boss', 'id', 'reward_item');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function itemAttribute(): HasOne
    {
        return $this->hasOne('App\Models\Item\ItemAttribute');
    }
}
