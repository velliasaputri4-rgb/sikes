<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Student\MedicalRecordController;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN LOGIN TERPISAH (Sesuai Pilihan di Navbar)
|--------------------------------------------------------------------------
*/
Route::get('/login-admin', function () {
    return view('auth.login-admin');
})->name('login.admin');

Route::get('/login-petugas', function () {
    return view('auth.login-petugas');
})->name('login.petugas');

Route::get('/login-siswa', function () {
    return view('auth.login-siswa');
})->name('login.siswa');

/*
|--------------------------------------------------------------------------
| 2. LANDING PAGE (PUBLIK - GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/tentang', [LandingController::class, 'about'])->name('landing.about');
Route::get('/informasi-obat', [LandingController::class, 'medicines'])->name('landing.medicines');
Route::get('/jadwal-petugas', [LandingController::class, 'schedule'])->name('landing.schedule');
Route::get('/kontak', [LandingController::class, 'contact'])->name('landing.contact');

/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATION (DARI BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 4. DASHBOARD ADMIN (CMS & MASTER DATA LENGKAP)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:super-admin|admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'adminIndex'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Data Master
    Route::resource('students', StudentController::class);
    Route::resource('examinations', ExaminationController::class);
    Route::resource('medicines', MedicineController::class);

    // CMS & Website Management
    Route::get('/cms', function() { return view('admin.cms.index'); })->name('cms.index');
    Route::get('/users', function() { return view('admin.users.index'); })->name('users.index');
    Route::get('/settings', function() { return view('admin.settings.index'); })->name('settings.index');
});

/*
|--------------------------------------------------------------------------
| 5. DASHBOARD PETUGAS (KHUSUS INPUT & KELOLA DATA HARIAN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/', [DashboardController::class, 'petugasIndex'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Input & Kelola Data Harian
    Route::resource('examinations', ExaminationController::class);
    Route::resource('medicines', MedicineController::class);
    Route::get('/students', function() { return view('petugas.students.index'); })->name('students.index');
    
    // ✅ TAMBAHAN: Route untuk Jadwal Petugas
    Route::resource('schedules', \App\Http\Controllers\ScheduleController::class);

    // ✅ TAMBAHAN: Route untuk Inventaris & Peminjaman
    Route::resource('items', \App\Http\Controllers\ItemController::class);
    Route::resource('borrowings', \App\Http\Controllers\BorrowingController::class);
    Route::patch('borrowings/{id}/return', [\App\Http\Controllers\BorrowingController::class, 'returnItem'])->name('borrowings.return');
});

/*
|--------------------------------------------------------------------------
| 6. RIWAYAT SISWA (KHUSUS ROLE SISWA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('student.')->group(function () {
    Route::get('/riwayat', [MedicalRecordController::class, 'index'])->name('history');
});

/*
|--------------------------------------------------------------------------
| 7. REDIRECT OTOMATIS SETELAH LOGIN (Berdasarkan Role)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function() {
    $user = auth()->user();
    
    if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('petugas')) {
        return redirect()->route('petugas.examinations.index');
    } elseif ($user->hasRole('siswa')) {
        return redirect()->route('student.history');
    }
    
    return redirect()->route('landing');
})->name('dashboard');