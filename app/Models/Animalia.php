<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animalia extends Model
{
    use HasFactory;
    protected $primaryKey = 'tsn';
    public $incrementing = false;
    protected $table = 'animalia';

    public function species()
    {
        return $this->hasMany(Species::class, 'tsn');
    }
}
