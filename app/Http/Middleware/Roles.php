<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Clinic;
class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $roles)
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
        if ($request->user() == null || !$request->user()->hasAnyRoles($roleArray, $clinic))
        {
            return redirect('noauth');
        }

        return $next($request);
    }
}
