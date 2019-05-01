<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function rarity()
    {
        return $this->belongsTo('App\Models\Item\ItemRarity', 'item_rarity_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User\User');
    }

    public function boss()
    {
        return $this->belongsTo('App\Models\Boss\Boss', 'id', 'reward_item');
    }

    public function itemAttribute()
    {
        return $this->hasOne('App\Models\Item\ItemAttribute');
    }
}
