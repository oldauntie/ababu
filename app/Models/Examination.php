<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnostic_test_id',
        'problem_id',
        'pet_id',
        'user_id',
        'result',
        'medical_report',
        'is_pathologic',
        'in_evidence',
        'notes',
        'print_notes',
    ];

    public function diagnosticTest()
    {
        return $this->belongsTo(DiagnosticTest::class);
    }
}
