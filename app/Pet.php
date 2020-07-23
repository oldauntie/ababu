<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public function specie()
    {
        return $this->belongsTo('App\Species');
    }
}
