<?php

namespace cms\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (\Auth::check() && ! \Entrust::hasRole($role)) 
        {
            return redirect()->back();
        }

        return $next($request);
    }
}
