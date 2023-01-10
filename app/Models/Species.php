<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tsn', 
        'clinic_id', 
        'familiar_name',
    ];


    public function animalia()
    {
        return $this->belongsTo(Animalia::class, 'tsn');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
