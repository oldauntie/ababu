<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Owner extends Model
{
    use HasFactory, SoftDeletes;

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

    // @todo: is in use?
    protected $appends = ['fullname'];

    protected $keyType = 'string';

    public $incrementing = false;

    # use UUID and soft delete cascade;
    protected static function boot()
    {
        parent::boot();

        # create and assign an UUID
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });

        # soft delete cascade
        self::deleting(function (Owner $owner) {
            foreach ($owner->pets as $pet) {
                $pet->delete();
            }
        });
    }

    // @todo: is in use?
    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

}
