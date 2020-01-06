<?php

namespace App\Services\API\Item;

use App\Models\Item\ItemRarity;
use Illuminate\Support\Collection;

class APIItemService
{
    /**
     * Get all item's rarities.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getItemRarities(): Collection
    {
        return ItemRarity::pluck('name', 'id');
    }
}
