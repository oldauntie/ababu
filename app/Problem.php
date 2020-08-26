<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Problem extends Model
{
    use SoftDeletes;


    public $statuses = [
        '-1' => 'problem_suspect',
        '0' => 'problem_closed',
        '1' => 'problem_active',
        '2' => 'problem_long_term_active',
        '3' => 'in_evidence',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function diagnosis()
    {
        return $this->belongsTo('App\Diagnosis');
    }

    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }
}
