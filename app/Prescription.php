<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function medicine()
    {
        return $this->belongsTo('App\Medicine');
    }
}
