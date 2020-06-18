<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class validateActive
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
        if(Auth::user()->activo==='0')
        {
            Auth::logout();
            return Redirect::to('/')->with('msg', 'Gracias por visitarnos!.');
        }
        return $next($request);
    }
}
