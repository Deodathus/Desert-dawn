<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemRarity extends Model
{
    public function items()
    {
        return $this->hasMany('App\Models\Item', 'item_rarity_id', 'id');
    }
}
