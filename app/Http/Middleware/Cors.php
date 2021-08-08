<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     Handle an incoming request.

     @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // X-Auth-Token
        header('Access-Control-Allow-Headers:  Content-Type, Authorization, Origin');
        header('Access-Control-Allow-Credentials:  true');
        header('Access-Control-Allow-Methods:  POST, PUT');
        return $next($request);
    }
}
