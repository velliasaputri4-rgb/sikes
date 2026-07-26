<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExaminationController;

/*
|--------------------------------------------------------------------------
| 1. LANDING PAGE (PUBLIK - GUEST)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Landing\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/tentang', [LandingController::class, 'about'])->name('landing.about');
Route::get('/informasi-obat', [LandingController::class, 'medicines'])->name('landing.medicines');
Route::get('/jadwal-petugas', [LandingController::class, 'schedule'])->name('landing.schedule');
Route::get('/kontak', [LandingController::class, 'contact'])->name('landing.contact');
/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATION (DARI BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 3. DASHBOARD (PROTECTED - LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    
    // Dashboard Utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
   
    |--------------------------------------------------------------------------
    | ROLE: SISWA
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:siswa'])->prefix('siswa')->name('student.')->group(function () {
        // Ganti closure function dengan controller
        Route::get('/riwayat', [\App\Http\Controllers\Student\MedicalRecordController::class, 'index'])->name('history');
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE: PETUGAS, ADMIN & SUPER ADMIN (Fitur Bersama)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|admin|petugas'])->group(function () {
        
        // Data Kunjungan / Pemeriksaan (Resource Route Lengkap)
        Route::resource('examinations', ExaminationController::class);
        
        // Data Siswa (Master Data)
        Route::resource('students', StudentController::class);
        
        // Placeholder untuk fitur lain (akan kita buat controllernya nanti)
           Route::resource('medicines', \App\Http\Controllers\MedicineController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE: ADMIN & SUPER ADMIN (CMS & Master Data Lanjutan)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|admin'])->group(function () {
        Route::get('/cms', function() { return view('cms.index'); })->name('cms.index');
        Route::get('/users', function() { return view('users.index'); })->name('users.index');
        Route::get('/officers', function() { return view('officers.index'); })->name('officers.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE: SUPER ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/roles', function() { return view('roles.index'); })->name('roles.index');
        Route::get('/audit-log', function() { return view('audit.index'); })->name('audit.index');
        Route::get('/settings', function() { return view('settings.index'); })->name('settings.index');
    });
});
