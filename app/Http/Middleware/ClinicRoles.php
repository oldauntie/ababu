<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClinicRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (is_object($request->clinic))
        {
            $clinic = $request->clinic;
        }
        else
        {
            $clinic = Clinic::findOrFail($request->clinic);
        }

        $roleArray = explode("|", $roles);

        if (auth()->check() && auth()->user()->hasAnyRolesByClinicId($roleArray, $clinic->id))
        {
            return $next($request);
        }

        return redirect('login');
        // return $next($request);
    }
}
