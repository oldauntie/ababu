<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

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
        return $this->belongsTo(Medicine::class);
    }
}
