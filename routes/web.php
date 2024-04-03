<?php

use App\Employee;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\Register2Controller;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\BreaktimeController;
use App\Http\Controllers\Admin\ScheduleController;
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

Route::get('/', function () {
    return redirect()->route('login');
});



Auth::routes(['register' => [Register2Controller::class]]);
Route::get('/employees/list-employees', [Register2Controller::class, 'index'])->name('register.index');
    Route::get('/employees/add-employee', [Register2Controller::class, 'create'])->name('register.create');
    Route::post('/employees', [RegisterController::class, 'store'])->name('register.store');
Route::get('/home', [HomeController::class,'index'])->name('index');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['auth','can:admin-access'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/reset-password', 'AdminController@reset_password')->name('reset-password');
    Route::put('/update-password', 'AdminController@update_password')->name('update-password');

    // Routes for employees //
    Route::get('/employees/list-employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/add-employee', [EmployeeController::class, 'clear'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

    //Routes untuk transaksi
    Route::get('/employees/attendance', [EmployeeController::class, 'attendance'])->name('employees.attendance');
    Route::post('/employees/attendance', [EmployeeController::class, 'attendance'])->name('employees.attendance');

    //Routes untuk delete
    Route::delete('/employees/attendance/{attendance_id}', [EmployeeController::class, 'attendanceDelete'])->name('employees.attendance.delete');
    Route::get('/employees/profile/{employee_id}', [EmployeeController::class, 'employeeProfile'])->name('employees.profile');
    Route::delete('/employees/{employee_id}', [EmployeeController::class, 'destroy'])->name('employees.delete');

    //Routes untuk Departemen
    Route::get('/employees/departement', [AdminController::class, 'departement'])->name('employees.department');
    Route::get('/departement/create', [AdminController::class, 'create'])->name('departement.create');
    Route::post('/departement', [AdminController::class, 'store'])->name('departement.store');
    Route::get('/departement/{id}/edit', [AdminController::class, 'edit'])->name('departement.edit');
    Route::put('/departement/update/{id}', [AdminController::class, 'update'])->name('departement.update');
    Route::delete('/departement/{id}', [AdminController::class, 'destroy'])->name('departement.destroy');

    //Routes untuk Time
    Route::get('timetable', [TimeController::class, 'index'])->name('timetable.index');
    Route::get('/timetable/create', [TimeController::class, 'create'])->name('timetable.create');
    Route::post('/admin/timetable', [TimeController::class, 'store'])->name('timetable.store');
    Route::get('/admin/timetable/{id}/edit', [TimeController::class, 'edit'])->name('timetable.edit');
    Route::put('/admin/timetable/{id}', [TimeController::class, 'update'])->name('timetable.update');
    Route::delete('/admin/timetable/{id}', [TimeController::class, 'destroy'])->name('timetable.destroy');


    //Route untuk Jabatan
     Route::get('positions', [PositionController::class, 'index'])->name('positions');
     Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
     Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
     Route::get('/positions/{id}/edit', [PositionController::class, 'edit'])->name('positions.edit');
     Route::put('/positions/{id}', [PositionController::class, 'update'])->name('positions.update');
     Route::delete('/positions/{id}', [PositionController::class, 'destroy'])->name('positions.destroy');

     //
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'updatev2'])->name('employees.update');

    //Routes for Breaktime
    Route::get('/breaktime', [BreaktimeController::class, 'index'])->name('breaktime.index');
    Route::get('/breaktime/create', [BreaktimeController::class, 'create'])->name('breaktime.create');
    Route::post('/breaktime', [BreaktimeController::class, 'store'])->name('breaktime.store');
    Route::get('/breaktime/{id}/edit', [BreaktimeController::class, 'edit'])->name('breaktime.edit');
    Route::put('/breaktime/{id}', [BreaktimeController::class, 'update'])->name('breaktime.update');
    Route::delete('/breaktime/{id}', [BreaktimeController::class, 'destroy'])->name('breaktime.destroy');

    // Routes for Shift
    Route::get('/shift', [ShiftController::class, 'index'])->name('shift.index');
    Route::get('/shift/create', [ShiftController::class, 'create'])->name('shift.create');
    Route::post('/shift', [ShiftController::class, 'store'])->name('shift.store');
    Route::get('/shift/{id}/edit', [ShiftController::class, 'edit'])->name('shift.edit');
    Route::put('/shift/{id}', [ShiftController::class, 'update'])->name('shift.update');
    Route::delete('/shift/{id}', [ShiftController::class, 'destroy'])->name('shift.destroy');

    // Routes for Schedule
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
});

