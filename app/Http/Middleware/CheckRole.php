<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if ( is_null($request->user()))
        {
            return abort(401);
        }
        else if($request->user()->rol!='admin')
        {
            return abort(401);   
        }
        return $next($request);
    }
}
