<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\UUID;

class Clinic extends Model
{
    use HasFactory, SoftDeletes;
    use UUID;

    protected $keyType = 'string';

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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function owners()
    {
        return $this->hasMany(Owner::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function species()
    {
        return $this->hasMany(Species::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    // @delete
    /*
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
    */

    
}
