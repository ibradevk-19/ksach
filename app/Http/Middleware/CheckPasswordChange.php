<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPasswordChange
{
    public function handle($request, Closure $next)
    {
        // التحقق مما إذا كان المستخدم قد قام بتغيير كلمة المرور
        if (Auth::check() && !Auth::user()->is_password_changed) {
            // التحقق مما إذا كان المستخدم بالفعل في صفحة تغيير كلمة المرور
            if ($request->route()->getName() !== 'password.change') {
                return redirect()->route('password.change'); // إعادة توجيه إلى صفحة تغيير كلمة المرور
            }
        }

        return $next($request);
    }
}
