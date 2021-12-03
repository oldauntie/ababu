<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'name',
        'serial',
        'key',
        'description',
        'manager',
        'code',
        'address',
        'postcode',
        'city',
        'phone',
        'website',
        'email',
        'logo'       
    ];

    protected $dates = ['deleted_at'];

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

    public function owners()
    {
        return $this->hasMany('App\Owner');
    }

    public function pets()
    {
        return $this->hasMany('App\Pet');
    }
}
