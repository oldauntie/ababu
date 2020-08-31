<?php

namespace App\Http\Middleware;

use Closure;
use App\Pet;

class CanCure
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
        // dd($request->pet);
        if (is_object($request->pet)) {
            $pet = $request->pet;
        } else {
            $pet = Pet::find($request->pet);
        }

        if ($pet != null) {
            if (auth()->check() && auth()->user()->canCure($pet)) {
                return $next($request);
            }
        }

        return redirect('login');
    }
}
