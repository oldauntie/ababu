<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Pet extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = [
        'created_at', 
        'updated_at', 
        'deleted_at', 
        'date_of_birth', 
        'date_of_death'
    ];

    protected $fillable = [
        'species_id',
        'clinic_id',
        'owner_id',
        'breed',
        'name',
        'sex',
        'date_of_birth',
        'date_of_death',
        'description',
        'color',
        'microchip',
        'microchip_location',
        'tatuatge',
        'tatuatge_location',
    ];


    protected $appends = ['age'];

    public function getAgeAttribute()
    {
        $toDate = $this->date_of_death == null ? Carbon::now() : $this->date_of_death;
        $formattedAge = $this->date_of_birth->diff($toDate)->format('%y,%m,%d');
        $tempAge = explode(',', $formattedAge);

        $age = new \stdClass();
        $age->years = $tempAge[0];
        $age->months = $tempAge[1];
        $age->days = $tempAge[2];

        return $age;
    }

    
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function problems()
    {
        return $this->hasMany(Problem::class);
    }

    // Note: renamed
    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    protected static function boot() {
        parent::boot();

        self::deleting(function (Pet $pet) {

            foreach ($pet->problems as $problem)
            {
                $problem->delete();
            }
        });
    }
}