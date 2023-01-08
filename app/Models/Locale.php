<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
