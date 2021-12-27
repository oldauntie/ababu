<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchdog extends Model
{
    protected $fillable = [
        'clinic_id',
        'user_id',
        'type',
        'message',
        'variables',
        'severity',
        'link',
        'request_uri',
        'referer',
        'ip'
    ];

    
    public static function write(Clinic $clinic, String $type)
    {
        return self::create([
            'clinic_id' => $clinic->id,
            'user_id' => auth()->user()->id,
            'type' => $type,
            'request_uri' => request()->getRequestUri(),
            'referer' => request()->headers->get('referer'),
            'ip' => request()->ip(),
        ]);

    }
    
}
