<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class ItemAttribute extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Models\Item\Item');
    }
}
