<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
