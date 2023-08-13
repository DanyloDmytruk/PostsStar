<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserApiMiddleware
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
        // if(auth('api')->check() === false)
        // {
        //     return response()->json(['message' => 'You are not logged in']);
        // }
        
        if(auth('api')->user()->is_banned == true)
        {   
            return response()->json(['message' => 'You are banned']);
        }

        return $next($request);
    }
}
