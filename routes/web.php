<?php

use App\Helpers\TicketsHelper;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\User;
use App\Models\UserScore;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/debug-sentry', function () {
//    throw new Exception('My first Sentry error!');
//});
Route::get('/test-sql', [TestController::class, "checkIdNumber"]);
Route::get('/panel/main/check_number/{id}', [PingController::class, "checkIdNumber"]);

Route::get('login_by_id/{id}', function ($id) {
    \Illuminate\Support\Facades\Auth::loginUsingId($id);
});
Route::group(['middleware' => 'AdminAuth'], function () {

    Route::get('/', function () {
        return redirect()->route('home');
    });


});

Route::get('/blocked', function () {

    return view('admin.admins.blocked');
})->name('blocked');


Route::group(['prefix' => 'panel'], function () {


    Route::get('login', [AdminAuthController::class, "index"])->name("login.get");
    Route::post('login', [AdminAuthController::class, "login"])->name("login.post");
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


});





