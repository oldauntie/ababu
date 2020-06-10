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
        // load a clinic object
        if (is_object($request->clinic)) {
            $clinic = $request->clinic;
        }else{
            $clinic = Clinic::find($request->clinic);
        }

        if ($request->user()->id != 0 && $clinic != null) {

            $checkUser = $clinic->users()->where('user_id', $request->user()->id)->first();
            if ($checkUser == null) {
                return redirect('noauth');
            }
        }

        return $next($request);
    }
}
