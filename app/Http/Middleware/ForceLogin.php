<?php

namespace App\Http\Middleware;

use Closure;

class ForceLogin
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
        if (! app()->environment('testing')) {
            auth()->loginUsingId(2);
        }
        return $next($request);
    }
}
