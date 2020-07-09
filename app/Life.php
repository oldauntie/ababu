<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Life extends Model
{
    protected $primaryKey = 'tsn';
    public $incrementing = false;

    public function species()
    {
        return $this->hasMany('App\Life', 'tsn');
    }
}
