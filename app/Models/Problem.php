<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Problem extends Model
{
    use HasFactory;
    use SoftDeletes;

    # to be used with UUIDs
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'diagnosis_id',
        'pet_id',
        'user_id',
        'status_id',
        'active_from',
        'key_problem',
        'description',
        'notes',
        'color',
    ];

    public const statuses = [
        '-1' => 'problem_suspect',
        '0' => 'problem_closed',
        '1' => 'problem_active',
        '2' => 'problem_long_term_active',
        '3' => 'in_evidence',
    ];

    public const colors = [
        'red' => '#DB2828',
        'orange' => '#F2711C',
        'yellow' => '#FBBD08',
        'olive' => '#B5CC18',
        'green' => '#21BA45',
        'teal' => '#00B5AD',
        'blue' => '#2185D0',
        'violet' => '#6435C9',
        'purple' => '#A333C8',
        'pink' => '#E03997'
    ];

    public function getStatusDescription($id)
    {
        return self::statuses[$id];
    }

    /*
    protected $dates = [
        'active_from', 
        'created_at', 
        'updated_at', 
        'deleted_at'
    ];
    */

    protected $casts = [
        'active_from' => 'datetime',
    ];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
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
