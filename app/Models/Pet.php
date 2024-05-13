<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    const SEXES = [
        'F',
        'M',
        '0',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_death' => 'date',
    ];

    protected $fillable = [
        'species_id',
        // 'clinic_id',
        'owner_id',
        'breed',
        'name',
        'sex',
        'date_of_birth',
        'date_of_death',
        'description',
        'color',
        'distinguishing_mark',
        'microchip',
        'microchip_location',
        'tatuatge',
        'tatuatge_location',
    ];

    protected $keyType = 'string';

    public $incrementing = false;
    
    protected $appends = ['age'];

    /**
     * Get the user's first name.
     */
    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getAge()
        );
    }

    private function getAge()
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


    // @delete me
    /*
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
    */
    public function medical_history()
    {
        return $this->hasOne(MedicalHistory::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function problems()
    {
        return $this->hasMany(Problem::class);
    }

    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    # use UUID and soft delete cascade;
    protected static function boot()
    {
        parent::boot();

        # create and assign an UUID as PK
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });

        self::deleting(function (Pet $pet) {
            foreach ($pet->problems as $problem) {
                $problem->delete();
            }
        });
    }
}
