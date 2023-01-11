<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        $roleArray = explode("|", $roles);
        if ($request->user() == null || !$request->user()->hasAnyRoles($roleArray))
        {
            return redirect('noauth');
        }

        return $next($request);
    }
}
