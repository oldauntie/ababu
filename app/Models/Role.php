<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class, 'role_user');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
