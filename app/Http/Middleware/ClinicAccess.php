<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClinicAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_object($request->clinic))
        {
            $clinic = $request->clinic;
        }
        else
        {
            $clinic = Clinic::find($request->clinic);
        }

        if ($clinic != null)
        {
            if (auth()->check() && auth()->user()->belongsToClinic($clinic->id))
            {
                return $next($request);
            }
        }

        return redirect('login');
        // return $next($request);
    }
}
