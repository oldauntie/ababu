<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    # to be used with UUIDs
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'diagnostic_test_id',
        'problem_id',
        'pet_id',
        'user_id',
        'examination_date',
        'result',
        'medical_report',
        'is_pathologic',
        'in_evidence',
        'notes',
        'print_notes',
    ];

    protected $casts = [
        'examination_date' => 'datetime',
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function diagnostic_test()
    {
        return $this->belongsTo(DiagnosticTest::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
