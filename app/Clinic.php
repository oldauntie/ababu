<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user');
    }
}
