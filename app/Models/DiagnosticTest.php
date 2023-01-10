<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticTest extends Model
{
    use HasFactory;

    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }
}
