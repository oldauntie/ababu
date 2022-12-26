<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'procedure_id',
        'pet_id',
        'user_id',
        'executed_at',
        'recall_at',
        'drug_batch',
        'drug_batch_expires_at',
        'notes',
        'print_notes',
    ];

    protected $dates = ['executed_at', 'recall_at', 'drug_batch_expires_at'];
    
    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }
}
