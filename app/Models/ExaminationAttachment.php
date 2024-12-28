<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationAttachment extends Model
{
    protected $fillable = [
        'file',
        'description'
    ];


    public function examination()
    {
        return $this->belongsTo(Examination::class);
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

        self::deleting(function (Pet $pet) {
            foreach ($pet->problems as $problem) {
                $problem->delete();
            }
        });
    }
}
