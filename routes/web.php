<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| SESI
|--------------------------------------------------------------------------
*/

Route::get('/buat-sesi', [SessionController::class, 'create'])
    ->name('sessions.create');

Route::get('/buat-sesi/pertemuan-selesai', [SessionController::class, 'completedMeetings'])
    ->name('sessions.completed-meetings');

Route::post('/buat-sesi', [SessionController::class, 'store'])
    ->name('sessions.store');

Route::get('/riwayat-sesi', [SessionController::class, 'history'])
    ->name('sessions.history');

Route::post('/akhiri-sesi', [SessionController::class, 'end'])
    ->name('sessions.end');

/*
|--------------------------------------------------------------------------
| SCANNER
|--------------------------------------------------------------------------
*/

Route::get('/scanner', function () {
    return view('scanner.index');
})->name('scanner');


/*
|--------------------------------------------------------------------------
| MAHASISWA
|--------------------------------------------------------------------------
*/

Route::get('/mahasiswa', [StudentController::class, 'index'])
    ->name('students.index');

Route::get('/mahasiswa/tambah', [StudentController::class, 'create'])
    ->name('students.create');

Route::post('/mahasiswa', [StudentController::class, 'store'])
    ->name('students.store');

Route::get('/mahasiswa/{id}/qr', [StudentController::class, 'qr'])
    ->name('students.qr');

Route::get('/mahasiswa/{id}/edit', [StudentController::class, 'edit'])
    ->name('students.edit');

Route::put('/mahasiswa/{id}', [StudentController::class, 'update'])
    ->name('students.update');

Route::delete('/mahasiswa/{id}', [StudentController::class, 'destroy'])
    ->name('students.destroy');

/*
|--------------------------------------------------------------------------
| ABSENSI
|--------------------------------------------------------------------------
*/

Route::post('/attendance/scan', [AttendanceController::class, 'scan'])
    ->name('attendance.scan');

Route::get('/riwayat-absensi', [AttendanceController::class, 'index'])
    ->name('attendance.index');