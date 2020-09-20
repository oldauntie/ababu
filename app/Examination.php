<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    public function diagnosticTest()
    {
        return $this->belongsTo('App\DiagnosticTest');
    }
}
