<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ApiLanguageHandler
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('user-language')) {
            config('app.locale', $request->get('user-language'));
            config('app.faker_locale', $request->get('user-language'));
            Carbon::setLocale($request->get('user-language'));
        } else {
            config('app.locale', 'ar');
            config('app.faker_locale', 'ar');
            Carbon::setLocale('ar');
        }
        return $next($request);
    }
}
