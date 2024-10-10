<?php

namespace App\Http\Controllers\Actor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Actor;

class ActorAuthController extends Controller
{
    public function __construct()
    {

        //$this->middleware('guest:actor')->except('logout');
    }

    public function index()
    {
        return  view('actor.auth.login');
    }

    public function login(Request $request)
    {


        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'id_num' => 'required|exists:actors,id_num',
            'password' => 'required',
        ], [
            'id_num.required' => 'رقم الهوية مطلوب.',
            'id_num.exists' => 'رقم الهوية غير موجود في سجلاتنا.',
            'password.required' => 'كلمة المرور مطلوبة.',
        ]);

        // البحث عن المستخدم بناءً على رقم الجوال
        $user = Actor::where('id_num', $request->input('id_num'))->first();
        // التحقق من كلمة المرور
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // تسجيل الدخول
            \Auth::guard('actor')->login($user);

            // إعادة توجيه المستخدم بعد تسجيل الدخول
            return redirect()->to('representative/index');
        }

        // في حالة فشل تسجيل الدخول
        return back()->withErrors([
            'id_num' => 'بيانات الهوية أو كلمة المرور غير صحيحة.',
        ])->withInput();

    }

    public function logout(){
        \Auth::guard('actor')->logout();
        return redirect()->route('actor.actor-login');
    }
}
