<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('frontend.forms.beneficial.auth.forgetPassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // تحديث كلمة المرور
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->is_password_changed = true;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'تم تغيير كلمة المرور بنجاح!');
    }
}
