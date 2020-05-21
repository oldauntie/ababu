<?php

namespace App\Http\Middleware;

use Closure;

class CheckClinic
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
        if($request->clinic != null)
        {
            $checkUser = $request->clinic->users()->where('user_id', $request->user()->id)->first();
            if($checkUser == null)
            {
                return redirect('noauth');
            }

        }
        // dd($request->user());

        



        return $next($request);
    }
}
