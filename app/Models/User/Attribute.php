<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function users()
    {
        return $this->belongsTo('App\Models\User\User');
    }
}
