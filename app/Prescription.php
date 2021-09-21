<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'medicine_id',
        'problem_id',
        'pet_id',
        'user_id',
        'quantity',
        'dosage',
        'duration',
        'in_evidence',
        'notes',
        'print_notes',
    ];

    public function medicine()
    {
        return $this->belongsTo('App\Medicine');
    }
}
