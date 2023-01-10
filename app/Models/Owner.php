<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Owner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'clinic_id',
        'country_id',
        'firstname',
        'lastname',
        'email',
        'phone_primary',
        'phone_secondary',
        'address',
        'postcode',
        'city',
        'ssn',
    ];

    protected $appends = ['fullname'];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Owner $owner)
        {

            foreach ($owner->pets as $pet)
            {
                $pet->delete();
            }
        });
    }
}
