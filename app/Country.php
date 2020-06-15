<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    public function countries()
    {
        return $this->hasMany(Clinic::class);
    }
}
