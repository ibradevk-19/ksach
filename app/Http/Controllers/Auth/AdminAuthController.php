<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function __construct()
    {

        $this->middleware('guest:admin')->except('logout');
    }

    public function index()
    {
        return  view('auth.login');
    }

    public function login(Request $request)
    {


        $this->validate($request, [
            'email' => 'required|email|exists:admins',
            'password' => 'required'
        ],[
            'email.required'=>'البريد الإلكتروني مطلوب',
            'email.email'=>'الرجاء إدخال بريد إلكتروني صحيح',
            'email.exists'=>'البريد الإلكتروني خاطئ',
            'password.required'=>'الرجاء إدخال كلمة السر',
        ]);

         if(\Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){

             return  redirect()->route('home')->with("success","تم تسجيل الدخول بنجاح");

        }else{
            return redirect()->back()->with("error","الرجاء التأكد من كلمة السر ");
        }

    }

    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect()->route('login.get');
    }


  

   

}
