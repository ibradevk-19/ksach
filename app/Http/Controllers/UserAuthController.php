<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('frontend.forms.beneficial.auth.login');
    }

    // عملية تسجيل الدخول
    public function login(Request $request)
    {

        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'id_number' => 'required|exists:users,id_number',
            'password' => 'required',
        ], [
            'id_number.required' => 'رقم الهوية مطلوب.',
            'id_number.exists' => 'رقم الهوية غير موجود في سجلاتنا.',
            'password.required' => 'كلمة المرور مطلوبة.',
        ]);

        // البحث عن المستخدم بناءً على رقم الجوال
        $user = User::where('id_number', $request->input('id_number'))->first();

        // التحقق من كلمة المرور
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // تسجيل الدخول
            Auth::login($user);

            // إعادة توجيه المستخدم بعد تسجيل الدخول
            return redirect()->to('dashboard');
        }

        // في حالة فشل تسجيل الدخول
        return back()->withErrors([
            'id_number' => 'بيانات الهوية أو كلمة المرور غير صحيحة.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
