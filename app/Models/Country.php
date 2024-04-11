<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }

    public function owners()
    {
        return $this->hasMany(Owner::class);
    }
}
