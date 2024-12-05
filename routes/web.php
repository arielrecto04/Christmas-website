<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Models\Attendance;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {


    $employeeAttendances = Employee::whereHas('attendance')->latest()->paginate(10);

    $totalAttendees = Attendance::count();

    $totalEmployees = Employee::count();

    return view('dashboard', compact('employeeAttendances', 'totalAttendees', 'totalEmployees'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('attendance')->as('attendance.')->group(function(){
    Route::get('', [AttendanceController::class, 'index'])->name('index');
    Route::post('', [AttendanceController::class, 'store'])->name('store');
    Route::get('{employee}/congrats', [AttendanceController::class, 'congrats'])->name('congrats');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('employees', EmployeeController::class);
});

require __DIR__.'/auth.php';
