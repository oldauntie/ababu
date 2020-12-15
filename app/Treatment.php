<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $dates = ['recall_at'];
    
    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }
}
