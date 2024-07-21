<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    # to be used with UUIDs
    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'pet_id',
        'user_id',
        'problem_id',
        'subjective',
        'objective',
        'assessment',
        'plan',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
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
