<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animalia extends Model
{
    protected $primaryKey = 'tsn';
    public $incrementing = false;
    protected $table = 'animalia';

    public function species()
    {
        return $this->hasMany('App\Species', 'tsn');
    }
}
