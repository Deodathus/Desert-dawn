<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemType extends Model
{
    /**
     * Relation with Item model.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'type', 'id');
    }
}
