<?php

namespace App\Http\Middleware;

use Closure;
use App\Clinic;

class ClinicRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (is_object($request->clinic)) {
            $clinic = $request->clinic;
        }else{
            $clinic = Clinic::findOrFail($request->clinic);
        }

        $roleArray = explode("|", $roles);

        if (auth()->check() && auth()->user()->hasAnyRolesByClinicId($roleArray, $clinic->id)) {
            return $next($request);
        }

        return redirect('login');
    }
}
