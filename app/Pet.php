<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use SoftDeletes;

    // Note: renamed
    public function species()
    {
        return $this->belongsTo('App\Species');
    }

    public function owner()
    {
        return $this->belongsTo('App\Owner');
    }
}
