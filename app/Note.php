<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'pet_id',
        'user_id',
        'note_text',
    ];
}
