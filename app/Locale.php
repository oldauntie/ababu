<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
