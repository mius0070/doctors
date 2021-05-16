<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isDoctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!(auth()->user()->type === 1)){
            return abort(404);
       }
        return $next($request);
    }
}
