<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\AdminControllers\RoleController;
use App\Http\Controllers\Admin\AdminControllers\AdminController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\DeliveryRecordController;
use App\Http\Controllers\Admin\BeneficialController;


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

$buildVersion = "1.0.0B8";
\View::share('buildVersion', $buildVersion);





Route::get('/', [HomeAdminController::class, 'home'])->name('home');

Route::get('/testHome', [HomeAdminController::class, 'testHome'])->name('testHome');

##################################################
################### Admins && Roles ######################
##################################################
Route::resource('admin', AdminController::class)->middleware(['CheckIfSuperAdmin']);
Route::resource('roles', RoleController::class)->middleware(['CheckIfSuperAdmin']);
Route::resource('roles', RoleController::class)->middleware(['CheckIfSuperAdmin']);
Route::get('roles_del', [RoleController::class, 'delete_roles'])->name('role.del');
Route::get('logout', [AdminAuthController::class, "logout"])->name("admin.logout")->middleware('AdminAuth');


Route::get('all-data', [MainController::class,'index'])->middleware(['CheckIfSuperAdmin'])->name('admin.main.index');;
Route::get('main/create', [MainController::class,'create'])->middleware(['CheckIfSuperAdmin'])->name('admin.main.create');;
Route::post('main/store', [MainController::class,'store'])->middleware(['CheckIfSuperAdmin'])->name('admin.main.store');;
Route::get('main/{id}/edit', [MainController::class,'edit'])->middleware(['CheckIfSuperAdmin'])->name('admin.main.edit');;
Route::get('main/{id}/details', [MainController::class,'details'])->middleware(['CheckIfSuperAdmin'])->name('admin.main.details');;

Route::delete('main/destroy/{id}', [MainController::class,'destroy'])->middleware(['CheckIfSuperAdmin'])->name('admin.main.destroy');;

// _______________________________
Route::get('profile', [AdminController::class, 'Profile'])->name('admin.profile.view');
Route::post('profile_store', [AdminController::class, 'Profile_update'])->name('admin.profile.store');
Route::get('import', [HomeAdminController::class, 'import'])->name('admin.import');
Route::post('import', [HomeAdminController::class, 'importNewIds'])->name('admin.importNewIds');

Route::get('import-res', [HomeAdminController::class, 'importRes'])->name('admin.import_res');

Route::get('export', [HomeAdminController::class, 'export'])->name('admin.export');
Route::get('/excel-check', [HomeAdminController::class, 'excelCheck'])->name('excel.check');

Route::resource('families', FamilyController::class);
Route::resource('actors', ActorController::class);

Route::get('invoices/export_invoices', [InvoiceController::class, 'storeExportCreate'])->name('admin.invoices.export_invoices');
Route::post('invoices/export_invoices/store', [InvoiceController::class, 'storeExport'])->name('admin.invoices.export_invoices_store');
Route::get('invoices/export_invoices/pdf', [InvoiceController::class, 'pdf']);
Route::get('invoices/create_invoices', [InvoiceController::class, 'createNew'])->name('admin.invoices.create_new');
Route::get('invoices/new_invoices', [InvoiceController::class, 'newIndex'])->name('admin.invoices.index_new');

Route::resource('products', ProductController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('categories', CategoryController::class);
Route::resource('providers', ProviderController::class);
Route::resource('period', ProductController::class);


Route::resource('units', UnitController::class);
Route::get('delivry/create', [DeliveryRecordController::class, 'create'])->name('delivry.create');
Route::post('delivry/store', [DeliveryRecordController::class, 'store'])->name('delivry.store');
Route::get('delivry', [DeliveryRecordController::class, 'index'])->name('delivry.index');

Route::get('delivry-record-import/{delivry_id}', [DeliveryRecordController::class, 'importForm'])->name('delivry.delivry-record-import');
Route::post('delivry-record-import', [DeliveryRecordController::class, 'import'])->name('delivry.delivry-record-import-post');
Route::get('delivry-record-list/{delivry_id}', [DeliveryRecordController::class, 'indexRecord'])->name('delivry.index-record');
Route::get('delivry-record-approval/{id}/{beneficial_id}', [DeliveryRecordController::class, 'approval'])->name('delivry.approval');

Route::get('delivry-record-allapproval/{delivery_record_id}', [DeliveryRecordController::class, 'approvalAll'])->name('delivry.approvalAll');
Route::get('delivry-record-print/{delivry_id}', [DeliveryRecordController::class, 'print'])->name('delivry.print');
Route::get('delivry-record-print/{delivry_id}/actor', [DeliveryRecordController::class, 'printActor'])->name('delivry.print-actor');

Route::post('delivry-record-print/actor-print', [DeliveryRecordController::class, 'printActorAction'])->name('delivry.print-actor-post');

Route::get('checker', [BeneficialController::class, 'create'])->name('checker.create');
Route::post('checker', [BeneficialController::class, 'checker'])->name('checker.store');
Route::get('checker-result', [BeneficialController::class, 'result'])->name('checker.result');


