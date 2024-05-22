<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Clinic;

class IsRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        # if is root user
        if (auth()->user()->id == '00000000-0000-0000-0000-000000000000') {
            return $next($request);
        }

        $io = $request->clinic;
        $clinic = Clinic::find($request->clinic);

        if (is_object($request->clinic)) {
            $clinic = $request->clinic;
        } else {
            $clinic = Clinic::findOrFail($request->clinic);
        }

        if ($request->user() == null || !$request->user()->isRole($role, $clinic)) {
            return redirect('noauth');
        }

        return $next($request);
    }
}
