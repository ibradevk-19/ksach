<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordEmail;
use App\Models\Admin;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {

        $this->middleware('guest:admin');
    }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {

          $request->validate([
              'email' => 'required|email|exists:admins',
          ],[
            'email.required'=>'البريد الإلكتروني مطلوب',
            'email.email'=>'الرجاء إدخال بريد إلكتروني صحيح',
            'email.exists'=>'البريد الإلكتروني خاطئ',
          ]);





          $token = Str::random(64);

          DB::table('password_resets')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => now(),
            ]);

            sendEmail($request->email,new ForgotPasswordEmail($token));



          return back()->with('success', 'لقد أرسلنا رابط إعادة تعيين كلمة المرور بالبريد الإلكتروني!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) {
        //   dd($token);
         return view('auth.forgetPasswordLink', ['token' => $token]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:admins',
              'password' => 'required|confirmed',
              'password_confirmation' => 'required'
          ],[
            [
                'email.required'=>'البريد الإلكتروني مطلوب',
                'email.email'=>'الرجاء إدخال بريد إلكتروني صحيح',
                'email.exists'=>'البريد الإلكتروني خاطئ',
                'password.required'=>'الرجاء إدخال كلمة المرور',
                'password.confirmed'=>'الكلمتان غير متطابقتان',


              ]
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'هذا الرابط غير فعال');
          }

          $user = Admin::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect()->route('login.get')->with('success', 'تم تغيير كلمة السر بنجاح');
      }
}
