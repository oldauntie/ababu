<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'serial',
        'key',
        'description',
        'logo'       
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
