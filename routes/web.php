<?php

use App\Models\User;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CandidateVoteController;

Route::get('/', function () {
    return to_route('disco-theme');
});

Route::get('/disco-theme', function () {
    return view('disco-theme');
})->name('disco-theme');


Route::prefix('attendance')->as('attendance.')->group(function () {
    Route::get('', [AttendanceController::class, 'index'])->name('index');
    Route::post('', [AttendanceController::class, 'store'])->name('store');
    Route::get('{user}/congrats', [AttendanceController::class, 'congrats'])->name('congrats');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('print-ticket', function () {
        $users = User::get();

        return view('ticket', compact('users'));
    })->name('print-ticket');
    Route::prefix('attendance')->as('attendance.')->group(function () {
        Route::delete('{attendance}', [AttendanceController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('surveys', SurveyController::class);

    Route::prefix('christmas')->name('christmas.')->group(function () {
        Route::get('/survey', [SurveyController::class, 'index'])->name('survey');

        Route::get('/vote', [CandidateVoteController::class, 'index'])->name('vote');
        Route::post('/vote/{candidate_id}', [CandidateVoteController::class, 'store'])->name('vote.store');

        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    });

    Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');

});

require __DIR__ . '/auth.php';
