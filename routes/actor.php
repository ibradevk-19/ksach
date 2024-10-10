<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Actor\HomeActorController;
use App\Http\Controllers\Actor\ActorAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;






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



 Route::get('representative/index', [HomeActorController::class, 'home'])->name('representative.index');

// Route::get('/testHome', [HomeAdminController::class, 'testHome'])->name('testHome');

Route::get('logout', [ActorAuthController::class, "logout"])->name("actor.logout-actor")->middleware('ActorAuth');
