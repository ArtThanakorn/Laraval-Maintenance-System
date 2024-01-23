<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ConfirmRepairController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TechnicianUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardTechnicianController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\EmployeeCRUDController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('login.page');

Route::get('/page/success', function () {
    return view('admin.confirmRepair');
});
// rounte Admin
Route::prefix('admin')->middleware('isadmin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashdoard');
    Route::get('user/add', [AdminUserController::class, 'add_adminuser'])->name('pages.addadmin');
    Route::post('account/pages', [AdminUserController::class, 'admin_user_store'])->name('store.userAdmin');
    Route::get('edit/{au_id}', [AdminUserController::class, 'admin_user_edit'])->name('edit.AuId');
    Route::post('user/update/{au_id}', [AdminUserController::class, 'admin_edituser_store'])->name('update.Au');
    Route::delete('user/destroy/{au_id}',[AdminUserController::class, 'admin_destroyuser'])->name('destroy.admin');

    // route technician
    Route::get('user/technician/add', [TechnicianUserController::class, 'index'])->name('technician.index');
    Route::get('edit/technician/{tu_id}', [TechnicianUserController::class, 'technician_user_edit'])->name('edit.TuId');
    Route::post('account/technician/pages', [TechnicianUserController::class, 'technician_user_store'])->name('store.account.technician');
    Route::post('user/updateUt/{tu_id}', [TechnicianUserController::class, 'technician_edituser_store'])->name('update.Tu');
    Route::delete('tradesman/destroy/{tu_id}',[TechnicianUserController::class, 'technician_destroyuser'])->name('destroy.tradesman');

    //แจ้งซ่อม
    Route::get('show/repair', [DashboardController::class, 'repair_show'])->name('show.repair');
});

// rounte Login && register
Route::get('/login/index', [LoginController::class, 'index']);
Route::get('/login/register', [RegisterController::class, 'index']);

// rounte Employee
Route::resource('/employee', EmployeeCRUDController::class);


// rounte users
Route::prefix('user')->group(function () {

    Route::get('repair', [RepairController::class, 'index'])->name('index.repair');
    Route::post('addrepair', [RepairController::class, 'store'])->name('add.repair');
    Route::get('confirm/repair/{id}', [RepairController::class, 'confirm_repair'])->name('user.confirmRepair');
});

// rount Technician
Route::get('/technician/dashboard', [DashboardTechnicianController::class, 'index'])->name('technician.dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
