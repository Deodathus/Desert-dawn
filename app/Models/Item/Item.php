<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'item_rarity_id',
        'name',
        'required_level',
        'type'
    ];

    /**
     * Relation with ItemRarity model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rarity(): BelongsTo
    {
        return $this->belongsTo('App\Models\Item\ItemRarity', 'item_rarity_id', 'id');
    }

    /**
     * Relation with User model.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User\User')->withPivot('active');
    }

    /**
     * Relation with Boss model.
     *
     * @return BelongsTo
     */
    public function boss(): BelongsTo
    {
        return $this->belongsTo('App\Models\Boss\Boss', 'id', 'reward_item');
    }

    /**
     * Relation with ItemAttribute model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function itemAttribute(): HasOne
    {
        return $this->hasOne('App\Models\Item\ItemAttribute');
    }

    /**
     * Relation with Mission model.
     *
     * @return BelongsTo
     */
    public function mission(): BelongsTo
    {
        return $this->belongsTo('App\Models\Quest\Mission', 'id', 'reward_item');
    }

    /**
     * Relation with Quest model.
     *
     * @return BelongsTo
     */
    public function quest(): BelongsTo
    {
        return $this->belongsTo('App\Models\Quest\Quest', 'id', 'reward_item');
    }

    /**
     * Relation with ItemType model.
     *
     * @return BelongsTo
     */
    public function itemType(): BelongsTo
    {
        return $this->belongsTo(ItemType::class, 'type', 'id');
    }
}
