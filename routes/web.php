<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| 1. LANDING PAGE (PUBLIK - GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/tentang', function () { return view('landing.about'); })->name('landing.about');
Route::get('/layanan', function () { return view('landing.services'); })->name('landing.services');
Route::get('/artikel', function () { return view('landing.articles'); })->name('landing.articles');
Route::get('/kontak', function () { return view('landing.contact'); })->name('landing.contact');

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
    
    // Dashboard Utama (Redirect sesuai role akan diatur di Controller)
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
        Route::get('/riwayat', function() { return 'Halaman Riwayat Siswa'; })->name('history');
        // Nanti kita isi controller-nya
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE: PETUGAS & ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|admin|petugas'])->group(function () {
        Route::get('/pemeriksaan', function() { return 'Halaman Pemeriksaan'; })->name('examinations.index');
        Route::get('/obat', function() { return 'Halaman Obat'; })->name('medicines.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE: ADMIN & SUPER ADMIN (CMS & MASTER DATA)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|admin'])->group(function () {
        Route::get('/cms', function() { return 'Halaman CMS'; })->name('cms.index');
        Route::get('/users', function() { return 'Halaman User'; })->name('users.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE: SUPER ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/roles', function() { return 'Halaman Roles'; })->name('roles.index');
        Route::get('/audit-log', function() { return 'Audit Log'; })->name('audit.index');
    });
});