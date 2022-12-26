<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchdog extends Model
{
    const WATCHDOG_CRITICAL = 4;
    const WATCHDOG_ERROR = 3;
    const WATCHDOG_WARNING = 2;
    const WATCHDOG_NOTICE = 1;
    const WATCHDOG_INFO = 0;
    const WATCHDOG_DEBUG = -1;

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

    protected $casts = [
        'variables' => 'array',
    ];

    
    public static function write(Clinic $clinic, String $type, Int $severity = 0, String $message = NULL, Array $variables = NULL)
    {
        return self::create([
            'clinic_id' => $clinic->id,
            'user_id' => auth()->user()->id,
            'type' => $type,
            'message' => $message,
            'variables' => $variables,
            'severity' => $severity,
            'request_uri' => request()->getRequestUri(),
            'referer' => request()->headers->get('referer'),
            'ip' => request()->ip(),
        ]);

    }
    
}
