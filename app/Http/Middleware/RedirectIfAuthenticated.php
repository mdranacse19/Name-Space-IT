<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard === 'company' && Auth::guard($guard)->check()) {

            return redirect()->route('company.dashboard');
        }if ($guard === 'applicant' && Auth::guard($guard)->check()) {

            return redirect()->route('applicant.dashboard');
        }


        return $next($request);

    }
}
