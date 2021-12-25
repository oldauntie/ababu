<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    protected $fillable = [
        'clinic_id', 
        'title', 
        'start', 
        'end'
    ];
}
