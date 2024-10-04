<?php

use App\Helpers\TicketsHelper;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\User;
use App\Models\UserScore;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PingController;
use App\Http\Controllers\BeneficialController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\DashboardContrller;
use App\Http\Controllers\LocationController;

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
Route::get('/panel/beneficial/check_number/{id}', [PingController::class, "checkIdNumber"]);

Route::get('login_by_id/{id}', function ($id) {
    \Illuminate\Support\Facades\Auth::loginUsingId($id);
});
Route::group(['middleware' => 'AdminAuth'], function () {




});


Route::post('beneficial/store', [BeneficialController::class, "store"])->name('beneficial.store');
Route::get('/get-cities/{province}', [LocationController::class, 'getCities']);
Route::get('/get-housing-complexes/{city}', [LocationController::class, 'getHousingComplexes']);
Route::get('/', [BeneficialController::class, 'crate']);



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





Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.custom');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// Route::get('/dashboard', function () {

// });

Route::get('/dashboard', [DashboardContrller::class, 'index'])->name('dashboard')->middleware('auth');

