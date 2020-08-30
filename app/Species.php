<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tsn', 'clinic_id', 'familiar_name',
    ];


    public function animalia()
    {
        return $this->belongsTo('App\Animalia', 'tsn');
    }

    public function pets()
    {
        return $this->hasMany('App\Pet');
    }
}
