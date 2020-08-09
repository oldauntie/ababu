<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'clinic_id',
        'country_id',
        'firstname',
        'lastname',
        'address',
        'postcode',
        'city',
        'ssn',
        'phone',
        'mobile',
        'email'
    ];

    protected static function boot() {
        parent::boot();
    
        static::deleting(function(Owner $owner) {
            $owner->pets()->delete();
        });
    }
    
    public function clinic()
    {
        return $this->belongsTo('App\Clinic');
    }

    public function pets()
    {
        return $this->hasMany('App\Pet');
    }
}
