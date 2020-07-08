<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tsn', 'clinic_id', 'familiar_name',
    ];
}
