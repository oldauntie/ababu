<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function clinics()
    {
        return $this->belongsToMany('App\Clinic', 'role_user');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
