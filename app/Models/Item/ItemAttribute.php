<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

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
    public function item()
    {
        return $this->belongsTo('App\Models\Item\Item');
    }
}
