<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\EmployeeCRUDController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
});

// rounte Admin
Route::get('/admin/dashboard', [DashboardController::class,'index']);
Route::get('/admin/repair', [RepairController::class,'index']);

// rounte Login && register
Route::get('/login/index', [LoginController::class,'index']);
Route::get('/login/register', [RegisterController::class,'index']);

// rounte Employee
Route::resource('/employee',EmployeeCRUDController::class);


// rounte admin
Route::prefix('user')->group(function () {

    Route::get('repair', [RepairController::class,'index'])->name('index.repair');
    Route::post('addrepair', [RepairController::class,'store'])->name('add.repair');
});
