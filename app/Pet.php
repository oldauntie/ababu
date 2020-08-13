<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Pet extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'date_of_birth', 'date_of_death'];

    protected $casts = [
        'date_of_birth' => 'datetime:d/m/Y',
        'date_of_death' => 'datetime:d/m/Y',
    ];



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
