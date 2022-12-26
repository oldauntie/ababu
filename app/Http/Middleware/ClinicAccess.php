<?php

namespace App\Http\Middleware;

use Closure;
use App\Clinic;

class ClinicAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_object($request->clinic)) {
            $clinic = $request->clinic;
        } else {
            $clinic = Clinic::find($request->clinic);
        }

        if ($clinic != null) {
            if (auth()->check() && auth()->user()->belongsToClinic($clinic->id)) {
                return $next($request);
            }
        }

        return redirect('login');
    }
}
