<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    # to be used with UUIDs
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'medicine_id',
        'problem_id',
        'pet_id',
        'user_id',
        'prescription_date',
        'quantity',
        'dosage',
        'duration',
        'in_evidence',
        'notes',
        'print_notes',
    ];

    protected $casts = [
        'prescription_date' => 'date',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
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
    }
}
