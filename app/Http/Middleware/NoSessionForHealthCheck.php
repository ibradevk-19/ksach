<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class NoSessionForHealthCheck
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request()->header('User-Agent') && strpos(request()->header('User-Agent'), 'HCLB-HealthCheck') !== false) {
            Config::set('session.driver', 'array');
        }

        return $next($request);
    }
}
