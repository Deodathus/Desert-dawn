<?php

namespace App\Services\API\Item;

use App\Models\Item\Item;
use App\Models\Item\ItemRarity;
use App\Models\Item\ItemType;
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

    /**
     * Get all item's types.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getItemTypes(): Collection
    {
        return ItemType::pluck('name', 'id');
    }

    /**
     * Get item by id.
     *
     * @param int $itemId
     *
     * @return \App\Models\Item\Item
     */
    public function getItem(int $itemId): Item
    {
        return Item::with('itemAttribute')->find($itemId);
    }
}
