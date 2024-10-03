<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ConfirmRepairController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\TechnicianUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardTechnicianController;
use App\Http\Controllers\PersonalInformationTechnicianController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\EmployeeCRUDController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Htpp\Controllers\ListTechnicianController;
use App\Http\Controllers\Admin\AdminPdfController;
use App\Http\Controllers\technician\TechnicianPdfController;
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
})->name('login.page')->middleware('caut');

// Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

Route::get('/page/success', function () {
    return view('admin.confirmRepair');
});
Auth::routes();
// rounte Admin
Route::prefix('admin')->middleware('isadmin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashdoard');
    Route::get('user/add', [AdminUserController::class, 'add_adminuser'])->name('pages.addadmin');
    Route::post('account/pages', [AdminUserController::class, 'admin_user_store'])->name('store.userAdmin');
    Route::get('edit/{au_id}', [AdminUserController::class, 'admin_user_edit'])->name('edit.AuId');
    Route::post('user/update/{au_id}', [AdminUserController::class, 'admin_edituser_store'])->name('update.Au');
    Route::post('user/reset/password/{au_id}', [AdminUserController::class, 'admin_user_reset_password']);
    Route::delete('user/destroy/{au_id}', [AdminUserController::class, 'admin_destroyuser'])->name('destroy.admin');

    // route technician
    Route::get('user/technician/add', [TechnicianUserController::class, 'index'])->name('technician.index');
    Route::get('edit/technician/{tu_id}', [TechnicianUserController::class, 'technician_user_edit'])->name('edit.TuId');
    Route::post('account/technician/pages', [TechnicianUserController::class, 'technician_user_store'])->name('store.account.technician');
    Route::post('user/updateUt/{tu_id}', [TechnicianUserController::class, 'technician_edituser_store'])->name('update.Tu');
    Route::post('tradesman/reset/password/{tu_id}', [TechnicianUserController::class, 'technician_reset_password'])->name('reset.Tu');
    Route::delete('tradesman/destroy/{tu_id}', [TechnicianUserController::class, 'technician_destroyuser'])->name('destroy.tradesman');
    //department
    Route::get('department/index', [DepartmentController::class, 'index'])->name('D.index');
    Route::post('department/edit/{id}', [DepartmentController::class, 'departmentEdit'])->name('D.edit');
    Route::post('department/create', [DepartmentController::class, 'createDepartment'])->name('D.create');
    Route::post('department/update/{id}', [DepartmentController::class, 'updateDepartment'])->name('D.update');
    Route::delete('department/destroy/{id}', [DepartmentController::class, 'destroy_department']);

    //ห้อง
    Route::get('room/index', [RoomController::class, 'IndexRoom'])->name('R.index');
    Route::post('room/create', [RoomController::class, 'Roomstore'])->name('R.create');
    Route::post('room/tool/create', [RoomController::class, 'RoomStoreEquipment'])->name('R.create.tool');
    Route::post('room/tool/remove', [RoomController::class, 'EquipmentUpdata'])->name('R.remove.tool');
    Route::post('room/update', [RoomController::class, 'EditNameRoom'])->name('R.updata');
    Route::delete('room/destroy/{id}', [RoomController::class, 'DeleteRoom'])->name('R.deleta');

    //แจ้งซ่อม
    Route::get('show/repair/{p}', [DashboardController::class, 'repair_show'])->name('show.repair');
    Route::post('repair/update', [DashboardController::class, 'setdepart'])->name('update.repair');
    Route::get('handle/repair', [RepairController::class, 'handle_repaair'])->name('handle.repair');
    Route::get('pdf/repair',[AdminPdfController::class, 'repair_all_pdf'])->name('R.PDF');
});

// rounte Login && register
Route::get('/login/index', [LoginController::class, 'index']);
Route::get('/login/register', [RegisterController::class, 'index']);

// rounte Employee
Route::resource('/employee', EmployeeCRUDController::class);

// rounte users
Route::prefix('user')->group(function () {
    Route::get('repair/{id}', [RepairController::class, 'index'])->name('index.repair');
    Route::post('addrepair', [RepairController::class, 'store'])->name('add.repair');
    Route::get('confirm/repair/{id}', [RepairController::class, 'confirm_repair'])->name('user.confirmRepair');
    Route::get('followup/repair', [RepairController::class, 'followUp'])->name('repair.followUp');
});

// rount Technician
Route::prefix('technician')->middleware('istradesmanrepair')->group(function () {
    Route::get('/dashboard', [DashboardTechnicianController::class, 'index'])->name('technician.dashboard');
    Route::get('/listwork/{p}',[DashboardTechnicianController::class, 'all_work'])->name('technician.listwork');
    Route::get('/personalinformation', [DashboardTechnicianController::class, 'Indexinformation'])->name('technician.info');
    // Route::get('/listRepair', [ListTechnicianController::class, 'index'])->name('technician.listRepair');
    Route::post('/workmoves', [DashboardTechnicianController::class, 'work_moves'])->name('moveswork');
    Route::post('/update/work/{id}', [DashboardTechnicianController::class, 'work_updata']);
    Route::post('/recipient/work', [DashboardTechnicianController::class, 'workRecipient'])->name('T.recipient');
    Route::post('/edit/personalInformation',[DashboardTechnicianController::class, 'edit_personal_info'])->name('T.edit.info');
    Route::get('/technicianStaff',[DashboardTechnicianController::class, 'IndexTechnicianStaff'])->name('T.Staff');
    Route::get('/workschedule/pdf',[TechnicianPdfController::class, 'generatePdf'])->name('T.PDF');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
