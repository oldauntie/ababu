<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UUID;

class MedicalHistory extends Model
{
    use HasFactory, UUID;

    protected $keyType = 'string';

    public $incrementing = false;
    

    protected $fillable= [
        'pet_id',
    ];

    const LIFE_STYLES = [
        'Exclusively indoor',
        'Exclusively outdoor',
        'Both indoor & outdoor'
    ];

    const FOOD_CONSUMPTIONS = [
        'Decreased',
        'Increased',
        'Stayed the same',
    ];
    
    const FOODS = [
        'dry food',
        'wet/canned food',
        'human food',
        'autonomous / wild food',
        'combination'
    ];

    const REPRODUCTIVE_STATUSES = [
        'Intact',
        'Spayed / Neutered'
    ];

    const WATER_CONSUMPTIONS = [
        'Decreased',
        'Increased',
        'Stayed the same',
    ];

    public function pet()
    {
        return $this->hasOne(Pet::class);
    }
}
