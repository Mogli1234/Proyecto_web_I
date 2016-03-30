<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotConfirmed
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
        if($request->user()->confirm==false){
            return redirect('/errors');
        }
        return $next($request);
    }
}