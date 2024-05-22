<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Clinic;
class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        # if is root user
        if(auth()->user()->id == '00000000-0000-0000-0000-000000000000')
        {
            return $next($request);
        }

        if (is_object($request->clinic))
        {
            $clinic = $request->clinic;
        }
        else
        {
            $clinic = Clinic::findOrFail($request->clinic);
        }

        
        if (auth()->check() && auth()->user()->hasRole($role, $clinic))
        {
            return $next($request);
        }

        return redirect('noauth');
    }



}
