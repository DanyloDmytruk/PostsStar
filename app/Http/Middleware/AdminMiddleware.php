<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() === false)
        {
            return redirect()->route('login');
        }
        
        if(auth()->user()->is_banned == true)
        {
            return redirect()->route('banned');
        }

        if(auth()->user()->role != 'admin'){
            return abort(403);
        }

        return $next($request);
    }
}
