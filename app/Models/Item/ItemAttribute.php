<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemAttribute extends Model
{
    protected $fillable = [
        'strength',
        'stamina',
        'agility',
        'intellect',
        'luck',
        'wisdom'
    ];

    /**
     * Relation with Item model.
     *
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo('App\Models\Item\Item');
    }
}
