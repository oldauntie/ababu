<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    public function treatments()
    {
        return $this->hasMany('App\Treatment');
    }
}
