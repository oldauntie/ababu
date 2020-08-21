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

    protected $appends = ['fullname'];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    
    public function clinic()
    {
        return $this->belongsTo('App\Clinic');
    }

    public function pets()
    {
        return $this->hasMany('App\Pet');
    }

    protected static function boot() {
        parent::boot();

        self::deleting(function (Owner $owner) {

            foreach ($owner->pets as $pet)
            {
                $pet->delete();
            }
        });
    }
}
