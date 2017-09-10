<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckSessionLocation
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
        if (!Session::has('location_id')) {
            Session::flash('error_finding_location','Select the location first and then try');
            return redirect('/');
        }
        return $next($request);
    }
}
