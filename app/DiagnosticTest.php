<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosticTest extends Model
{
    public function examinations()
    {
        return $this->hasMany('App\Examination');
    }
}
