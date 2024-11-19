<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'user_id',
        'vaccine',
        'batch',
        'vaccination_date',
        'booster_date',
        'production_date',
        'expiration_date',
        'adverse_reactions',
        'notes',
    ];

    # to be used with UUIDs
    protected $keyType = 'string';
    public $incrementing = false;


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
