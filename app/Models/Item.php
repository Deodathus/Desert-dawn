<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function rarity()
    {
        return $this->belongsTo('App\Models\ItemRarity', 'item_rarity_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
