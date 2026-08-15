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
| 1. HALAMAN LOGIN (ADMIN & PETUGAS DIGABUNG, SISWA TERPISAH)
|--------------------------------------------------------------------------
*/
Route::get('/login-admin', function () { return redirect()->route('login'); })->name('login.admin');
Route::get('/login-petugas', function () { return redirect()->route('login'); })->name('login.petugas');
Route::get('/login-siswa', function () { return view('auth.login-siswa'); })->name('login.siswa');

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
| 3.5. INPUT KUNJUNGAN (PUBLIK - TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('examinations/create', [ExaminationController::class, 'create'])->name('examinations.create');
    Route::post('examinations', [ExaminationController::class, 'store'])->name('examinations.store');
    Route::get('examinations/cari-siswa/{nis}', [ExaminationController::class, 'searchStudent'])->name('examinations.search');
});

/*
|--------------------------------------------------------------------------
| 4. DASHBOARD ADMIN (CMS & MASTER DATA LENGKAP)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:super-admin|admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'adminIndex'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('students', StudentController::class);
    Route::resource('examinations', ExaminationController::class);
    Route::resource('medicines', MedicineController::class);
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('examinations', [ExaminationController::class, 'index'])->name('examinations.index');
    Route::get('examinations/{examination}', [ExaminationController::class, 'show'])->name('examinations.show');
    Route::get('examinations/{examination}/edit', [ExaminationController::class, 'edit'])->name('examinations.edit');
    Route::put('examinations/{examination}', [ExaminationController::class, 'update'])->name('examinations.update');
    Route::delete('examinations/{examination}', [ExaminationController::class, 'destroy'])->name('examinations.destroy');

    Route::resource('medicines', MedicineController::class);

    // ===== ✅ DATA SISWA (PETUGAS) =====
    Route::get('/students', function () {
        $search = request('search');
        $students = \App\Models\Student::with('class')
            ->when($search, function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%");
            })
            ->latest()->simplePaginate(25)->withQueryString();
        return view('petugas.students.index', compact('students'));
    })->name('students.index');

    Route::get('students/create', function () {
        $classes = (new \App\Models\Student)->class()->getRelated()->orderBy('name')->get();
        return view('petugas.students.create', compact('classes'));
    })->name('students.create');

    // ✅ Fungsi helper untuk membuat kelas baru (dengan kode unik)
    $createNewClass = function ($newClassName) {
        $classModelClass = get_class((new \App\Models\Student)->class()->getRelated());
        $classTableName = (new $classModelClass)->getTable();
        
        $class = $classModelClass::where('name', trim($newClassName))->first();
        
        if (! $class) {
            // Ambil kelas pertama sebagai template
            $templateClass = \Illuminate\Support\Facades\DB::table($classTableName)->first();
            
            if ($templateClass) {
                // Salin semua kolom dari template
                $insertData = (array) $templateClass;
                // Ganti name dengan nama kelas baru
                $insertData['name'] = trim($newClassName);
                
                // ✅ Generate kode unik berdasarkan nama kelas + timestamp
                $cleanName = strtoupper(preg_replace('/[^A-Za-z0-9]/', '_', trim($newClassName)));
                $insertData['code'] = $cleanName . '_' . time();
                
                // Hapus kolom auto-generated
                unset($insertData['id'], $insertData['created_at'], $insertData['updated_at'], $insertData['deleted_at']);
                
                $classId = \Illuminate\Support\Facades\DB::table($classTableName)->insertGetId($insertData);
                $class = $classModelClass::find($classId);
            } else {
                // Fallback jika tidak ada kelas sama sekali
                $cleanName = strtoupper(preg_replace('/[^A-Za-z0-9]/', '_', trim($newClassName)));
                $classId = \Illuminate\Support\Facades\DB::table($classTableName)->insertGetId([
                    'name' => trim($newClassName),
                    'code' => $cleanName . '_' . time(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $class = $classModelClass::find($classId);
            }
        }
        
        return $class;
    };

    // Simpan Siswa Baru
    Route::post('students', function (\Illuminate\Http\Request $request) use ($createNewClass) {
        $data = $request->validate([
            'nis'        => 'required|string|max:20|unique:students,nis',
            'full_name'  => 'required|string|max:100',
            'class_name' => 'required|string|max:50',
            'birth_date' => 'required|date',
        ], [
            'nis.unique'          => 'NIS tersebut sudah terdaftar di database.',
            'class_name.required' => 'Kelas wajib diisi (pilih atau ketik kelas baru).',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($data, $createNewClass) {
            $class = $createNewClass($data['class_name']);

            $user = \App\Models\User::create([
                'name' => $data['full_name'], 'email' => $data['nis'] . '@sikes.sch.id',
                'password' => \Illuminate\Support\Facades\Hash::make('siswa123'),
            ]);
            $user->assignRole('siswa');

            \App\Models\Student::create([
                'user_id' => $user->id, 'nis' => $data['nis'], 'full_name' => $data['full_name'],
                'classroom_id' => $class->id, 'birth_date' => $data['birth_date'],
            ]);
        });
        return redirect()->route('petugas.students.index')->with('success', 'Siswa baru berhasil ditambahkan! Password: siswa123');
    })->name('students.store');

    Route::get('students/{id}/edit', function ($id) {
        $student = \App\Models\Student::findOrFail($id);
        $classes = (new \App\Models\Student)->class()->getRelated()->orderBy('name')->get();
        return view('petugas.students.edit', compact('student', 'classes'));
    })->name('students.edit');

    // Update Siswa
    Route::put('students/{id}', function (\Illuminate\Http\Request $request, $id) use ($createNewClass) {
        $student = \App\Models\Student::findOrFail($id);
        $data = $request->validate([
            'nis'        => 'required|string|max:20|unique:students,nis,' . $id,
            'full_name'  => 'required|string|max:100',
            'class_name' => 'required|string|max:50',
            'birth_date' => 'nullable|date',
        ], [
            'nis.unique' => 'NIS tersebut sudah terdaftar di database.',
        ]);

        $class = $createNewClass($data['class_name']);

        $student->update([
            'nis' => $data['nis'], 'full_name' => $data['full_name'], 'classroom_id' => $class->id,
            'birth_date' => $data['birth_date'] ?? null,
        ]);
        return redirect()->route('petugas.students.index')->with('success', 'Data siswa berhasil diperbarui!');
    })->name('students.update');

    // ✅ HAPUS SISWA (Trash)
    Route::delete('students/{id}', function ($id) {
        $student = \App\Models\Student::findOrFail($id);
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($student) {
                $userId = $student->user_id;
                $student->delete();
                if ($userId) \App\Models\User::where('id', $userId)->delete();
            });
            return redirect()->route('petugas.students.index')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->route('petugas.students.index')->with('error', 'Gagal menghapus: data siswa masih terpakai di riwayat kunjungan.');
        }
    })->name('students.destroy');

    Route::resource('schedules', \App\Http\Controllers\ScheduleController::class);
    Route::resource('items', \App\Http\Controllers\ItemController::class);
    Route::resource('borrowings', \App\Http\Controllers\BorrowingController::class);
    Route::patch('borrowings/{id}/return', [\App\Http\Controllers\BorrowingController::class, 'returnItem'])->name('borrowings.return');
});

/*
|--------------------------------------------------------------------------
| 6. RIWAYAT SISWA (KHUSUS ROLE SISWA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/riwayat', [MedicalRecordController::class, 'index'])->name('history');
});

/*
|--------------------------------------------------------------------------
| 7. REDIRECT OTOMATIS SETELAH LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function() {
    $user = auth()->user();
    if ($user->hasRole('super-admin') || $user->hasRole('admin')) return redirect()->route('admin.dashboard');
    elseif ($user->hasRole('petugas')) return redirect()->route('petugas.dashboard');
    elseif ($user->hasRole('siswa')) return redirect()->route('siswa.history');
    return redirect()->route('landing');
})->name('dashboard');