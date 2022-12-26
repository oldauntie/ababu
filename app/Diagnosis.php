<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    public function problems()
    {
        return $this->hasMany('App\Problem');
    }
}
