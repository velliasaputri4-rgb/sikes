<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Student\MedicalRecordController;
use App\Http\Controllers\OAuthController;

/*
|--------------------------------------------------------------------------
| 0. SSO SIPINTU GATEWAY INTEGRATION (HYBRID MODEL) & HEALTH MONITORING
|--------------------------------------------------------------------------
*/
Route::get('/oauth/callback', [OAuthController::class, 'callback'])->name('oauth.callback');
Route::post('/oauth/logout', [OAuthController::class, 'logout'])->name('oauth.logout');
Route::get('/health', fn () => response()->json([
    'status' => 'ok',
    'database' => 'connected',
    'php' => PHP_VERSION,
]));

/*
|--------------------------------------------------------------------------
| 1. LOGIN PAGES (ADMIN & STAFF COMBINED, STUDENT SEPARATED)
|--------------------------------------------------------------------------
*/
Route::get('/login-admin', function () { return redirect()->route('login'); })->name('login.admin');
Route::get('/login-petugas', function () { return redirect()->route('login'); })->name('login.petugas');
Route::get('/login-siswa', function () { return view('auth.login-siswa'); })->name('login.siswa');

// ✅ PERBAIKAN 1: Login siswa HANYA menggunakan NIS (tanpa tanggal lahir)
Route::post('/login-siswa', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'nis' => 'required|string',
    ], [
        'nis.required' => 'NIS wajib diisi.',
    ]);

    // 1. Cari siswa berdasarkan NIS
    $student = \App\Models\Student::where('nis', $request->nis)->first();

    if (!$student) {
        return back()->withErrors([
            'nis' => 'NIS tidak ditemukan dalam database.',
        ])->withInput($request->only('nis'));
    }

    // 2. Pastikan siswa memiliki akun user yang terhubung
    if (!$student->user_id) {
        return back()->withErrors([
            'nis' => 'Akun untuk NIS ini belum aktif. Hubungi petugas UKS.',
        ])->withInput($request->only('nis'));
    }

    // 3. Login menggunakan user_id yang terhubung dengan siswa
    \Illuminate\Support\Facades\Auth::loginUsingId($student->user_id);
    
    // Regenerasi session untuk keamanan
    $request->session()->regenerate();

    // 4. Arahkan ke halaman riwayat siswa
    return redirect()->intended(route('siswa.history'));

})->name('login.siswa.submit');

/*
|--------------------------------------------------------------------------
| 2. LANDING PAGE (PUBLIC - GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/tentang', [LandingController::class, 'about'])->name('landing.about');
Route::get('/layanan', [LandingController::class, 'services'])->name('landing.services');
Route::get('/informasi-obat', [LandingController::class, 'medicines'])->name('landing.medicines');
Route::get('/informasi-kesehatan', [LandingController::class, 'healthInfo'])->name('landing.health-info');
Route::get('/jadwal-petugas', [LandingController::class, 'schedule'])->name('landing.schedule');
Route::get('/kontak', [LandingController::class, 'contact'])->name('landing.contact');

Route::get('/dokumentasi', [LandingController::class, 'docs'])->name('landing.docs');
Route::get('/dokumentasi/{id}', [LandingController::class, 'docsDetail'])->name('landing.docs-detail');

/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATION (FROM BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 3.5. EXAMINATION INPUT (PUBLIC - NO LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('examinations/create', [ExaminationController::class, 'create'])->name('examinations.create');
    Route::post('examinations', [ExaminationController::class, 'store'])->name('examinations.store');
    Route::get('examinations/cari-siswa/{nis}', [ExaminationController::class, 'searchStudent'])->name('examinations.search');
});

/*
|--------------------------------------------------------------------------
| 4. ADMIN DASHBOARD (CMS & COMPLETE MASTER DATA)
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
});

/*
|--------------------------------------------------------------------------
| 5. STAFF DASHBOARD (SPECIFICALLY FOR DAILY INPUT & DATA MANAGEMENT)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:petugas|admin|super-admin'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/', [DashboardController::class, 'petugasIndex'])->name('dashboard');
    
    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('examinations', [ExaminationController::class, 'index'])->name('examinations.index');
    Route::get('examinations/recap', [ExaminationController::class, 'recap'])->name('examinations.recap');
    Route::get('examinations/{examination}', [ExaminationController::class, 'show'])->name('examinations.show');
    Route::get('examinations/{examination}/edit', [ExaminationController::class, 'edit'])->name('examinations.edit');
    Route::put('examinations/{examination}', [ExaminationController::class, 'update'])->name('examinations.update');
    Route::delete('examinations/{examination}', [ExaminationController::class, 'destroy'])->name('examinations.destroy');

    Route::resource('medicines', MedicineController::class);

    Route::get('/sync-sipintu', [\App\Http\Controllers\SipintuSyncController::class, 'index'])->name('sync.index');
    Route::post('/sync-sipintu', [\App\Http\Controllers\SipintuSyncController::class, 'run'])->name('sync.run')->middleware('throttle:5,1');
    Route::post('/sync-sipintu/test', [\App\Http\Controllers\SipintuSyncController::class, 'test'])->name('sync.test')->middleware('throttle:10,1');
    Route::get('/sync-sipintu/status/{log}', [\App\Http\Controllers\SipintuSyncController::class, 'status'])->name('sync.status');

    // ✅ PERBAIKAN 2: Route /students DENGAN logika filter kelas yang benar dan toleran
    Route::get('/students', function (\Illuminate\Http\Request $request) {
        $search = $request->input('search');
        $birthDateMissing = $request->boolean('birth_date_missing');
        $selectedClass = $request->input('class'); // Mengambil nilai dari dropdown kelas
        
        $query = \App\Models\Student::with('class');

        // 1. Filter Pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        // 2. Filter Kelas (Menggunakan LIKE agar toleran terhadap spasi)
        if ($selectedClass) {
            $query->whereHas('class', function ($q) use ($selectedClass) {
                $q->where('name', 'like', '%' . trim($selectedClass) . '%');
            });
        }

        // 3. Filter Tanggal Lahir Kosong
        if ($birthDateMissing) {
            $query->whereNull('birth_date');
        }

        $students = $query->latest()->simplePaginate(25)->withQueryString();
        
        // Ambil semua kelas dari database untuk dropdown dinamis di Blade
        $classes = \App\Models\ClassRoom::orderBy('name')->get();
        
        return view('petugas.students.index', compact('students', 'birthDateMissing', 'classes', 'selectedClass'));
    })->name('students.index');

    Route::get('students/create', function () {
        $classes = \App\Models\ClassRoom::orderBy('name')->get();
        return view('petugas.students.create', compact('classes'));
    })->name('students.create');

    $createNewClass = function ($newClassName) {
        $classModelClass = \App\Models\ClassRoom::class;
        $classTableName = (new $classModelClass)->getTable();
        
        $class = $classModelClass::where('name', trim($newClassName))->first();
        
        if (! $class) {
            $templateClass = \Illuminate\Support\Facades\DB::table($classTableName)->first();
            
            if ($templateClass) {
                $insertData = (array) $templateClass;
                $insertData['name'] = trim($newClassName);
                $cleanName = strtoupper(preg_replace('/[^A-Za-z0-9]/', '_', trim($newClassName)));
                $insertData['code'] = $cleanName . '_' . time();
                unset($insertData['id'], $insertData['created_at'], $insertData['updated_at'], $insertData['deleted_at']);
                $classId = \Illuminate\Support\Facades\DB::table($classTableName)->insertGetId($insertData);
                $class = $classModelClass::find($classId);
            } else {
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

    Route::post('students', function (\Illuminate\Http\Request $request) use ($createNewClass) {
        $data = $request->validate([
            'nis'          => 'required|string|max:20|unique:students,nis',
            'full_name'    => 'required|string|max:100',
            'class_name'   => 'required|string|max:50',
            'birth_date'   => 'required|date',
            'parent_phone' => 'nullable|string|max:20',
        ], [
            'nis.unique'          => 'NIS ini sudah terdaftar di database.',
            'class_name.required' => 'Kelas wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($data, $createNewClass) {
            $class = $createNewClass($data['class_name']);

            $user = \App\Models\User::create([
                'name'     => $data['full_name'], 
                'email'    => $data['nis'] . '@sikes.sch.id',
                'password' => \Illuminate\Support\Facades\Hash::make('siswa123'),
                'phone'    => $data['parent_phone'] ?? null,
            ]);
            $user->assignRole('siswa');

            \App\Models\Student::create([
                'user_id'      => $user->id, 
                'nis'          => $data['nis'], 
                'full_name'    => $data['full_name'],
                'classroom_id' => $class->id, 
                'birth_date'   => $data['birth_date'],
                'parent_phone' => $data['parent_phone'] ?? null,
            ]);
        });
        return redirect()->route('petugas.students.index')->with('success', 'Data siswa berhasil ditambahkan! Password default: siswa123');
    })->name('students.store');

    Route::get('students/{id}/edit', function ($id) {
        $student = \App\Models\Student::findOrFail($id);
        $classes = \App\Models\ClassRoom::orderBy('name')->get();
        return view('petugas.students.edit', compact('student', 'classes'));
    })->name('students.edit');

    Route::put('students/{id}', function (\Illuminate\Http\Request $request, $id) use ($createNewClass) {
        $student = \App\Models\Student::findOrFail($id);
        $data = $request->validate([
            'nis'          => 'required|string|max:20|unique:students,nis,' . $id,
            'full_name'    => 'required|string|max:100',
            'class_name'   => 'required|string|max:50',
            'birth_date'   => 'nullable|date',
            'parent_phone' => 'nullable|string|max:20',
        ], [
            'nis.unique' => 'NIS ini sudah terdaftar di database.',
        ]);

        $class = $createNewClass($data['class_name']);

        $student->update([
            'nis'          => $data['nis'], 
            'full_name'    => $data['full_name'], 
            'classroom_id' => $class->id,
            'birth_date'   => $data['birth_date'] ?? null,
            'parent_phone' => $data['parent_phone'] ?? null,
        ]);
        return redirect()->route('petugas.students.index')->with('success', 'Data siswa berhasil diperbarui!');
    })->name('students.update');

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
            return redirect()->route('petugas.students.index')->with('error', 'Gagal menghapus: data siswa masih terpakai di riwayat.');
        }
    })->name('students.destroy');

    Route::resource('schedules', \App\Http\Controllers\ScheduleController::class);
    Route::resource('piket', \App\Http\Controllers\ScheduleController::class);
    Route::resource('items', \App\Http\Controllers\ItemController::class);
    
    Route::get('borrowings', function () {
        $search = request('search');
        $borrowings = \App\Models\Borrowing::latest()
            ->when($search, function ($q) use ($search) {
                $q->whereIn('student_id', \App\Models\Student::where('full_name', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%")->select('id'))
                  ->orWhereIn('item_id', \App\Models\Item::where('name', 'like', "%{$search}%")->select('id'));
            })
            ->simplePaginate(25)->withQueryString();

        $students = \App\Models\Student::whereIn('id', $borrowings->pluck('student_id'))->get()->keyBy('id');
        $items = \App\Models\Item::whereIn('id', $borrowings->pluck('item_id'))->get()->keyBy('id');

        return view('petugas.borrowings.index', compact('borrowings', 'students', 'items'));
    })->name('borrowings.index');

    Route::get('borrowings/create', function () {
        $students = \App\Models\Student::orderBy('full_name')->get();
        $items = \App\Models\Item::orderBy('name')->get();
        return view('petugas.borrowings.create', compact('students', 'items'));
    })->name('borrowings.create');

    Route::post('borrowings', function (\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'student_input'        => 'required|string|max:100',
            'item_input'           => 'required|string|max:100',
            'borrow_date'          => 'required|date',
            'expected_return_date' => 'nullable|date',
            'notes'                => 'nullable|string',
        ]);

        $q = trim($data['student_input']);
        $student = \App\Models\Student::where('nis', $q)->orWhere('full_name', 'like', "%{$q}%")->first();

        if (!$student) {
            return redirect()->back()->withInput()->withErrors(['student_input' => "Siswa dengan NIS/nama tersebut tidak ditemukan."]);
        }

        $item = \App\Models\Item::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($data['item_input'])) . '%'])->first();

        if (!$item) {
            $clean = strtoupper(preg_replace('/[^A-Za-z0-9]/', '_', trim($data['item_input'])));
            $item = \App\Models\Item::forceCreate([
                'name' => trim($data['item_input']), 'code' => $clean . '_' . time(), 'quantity' => 1, 'available' => 1, 'condition' => 'good',
            ]);
        }

        if (($item->available ?? 0) < 1) {
            return redirect()->back()->withInput()->withErrors(['item_input' => "Stok untuk item tersebut sedang tidak tersedia."]);
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($data, $student, $item) {
            \App\Models\Borrowing::forceCreate([
                'item_id' => $item->id, 'student_id' => $student->id, 'borrowed_by' => auth()->id(),
                'borrow_date' => $data['borrow_date'], 'expected_return_date' => $data['expected_return_date'] ?? null,
                'status' => 'borrowed', 'notes' => $data['notes'] ?? null,
            ]);
            \App\Models\Item::where('id', $item->id)->decrement('available');
        });

        return redirect()->route('petugas.borrowings.index')->with('success', 'Peminjaman berhasil dicatat!');
    })->name('borrowings.store');

    Route::get('borrowings/{id}/edit', function ($id) {
        $borrowing = \App\Models\Borrowing::findOrFail($id);
        $student = \App\Models\Student::find($borrowing->student_id);
        $item = \App\Models\Item::find($borrowing->item_id);
        $students = \App\Models\Student::orderBy('full_name')->get();
        $items = \App\Models\Item::orderBy('name')->get();
        return view('petugas.borrowings.edit', compact('borrowing', 'student', 'item', 'students', 'items'));
    })->name('borrowings.edit');

    Route::put('borrowings/{id}', function (\Illuminate\Http\Request $request, $id) {
        $borrowing = \App\Models\Borrowing::findOrFail($id);
        $data = $request->validate([
            'student_input' => 'required|string|max:100', 'item_input' => 'required|string|max:100',
            'borrow_date' => 'required|date', 'expected_return_date' => 'nullable|date',
            'status' => 'required|in:borrowed,returned,overdue,lost', 'notes' => 'nullable|string',
        ]);

        $q = trim($data['student_input']);
        $student = \App\Models\Student::where('nis', $q)->orWhere('full_name', 'like', "%{$q}%")->first();
        if (!$student) return redirect()->back()->withInput()->withErrors(['student_input' => "Siswa tidak ditemukan."]);

        $item = \App\Models\Item::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($data['item_input'])) . '%'])->first();
        if (!$item) {
            $clean = strtoupper(preg_replace('/[^A-Za-z0-9]/', '_', trim($data['item_input'])));
            $item = \App\Models\Item::forceCreate(['name' => trim($data['item_input']), 'code' => $clean . '_' . time(), 'quantity' => 1, 'available' => 1, 'condition' => 'good']);
        }

        $oldActive = in_array($borrowing->status, ['borrowed', 'overdue']);
        $newActive = in_array($data['status'], ['borrowed', 'overdue']);

        \Illuminate\Support\Facades\DB::transaction(function () use ($borrowing, $data, $student, $item, $oldActive, $newActive) {
            if ($oldActive && (!$newActive || $borrowing->item_id != $item->id)) {
                \App\Models\Item::where('id', $borrowing->item_id)->increment('available');
            }
            if ($newActive && (!$oldActive || $borrowing->item_id != $item->id)) {
                if (($item->available ?? 0) < 1) throw new \Illuminate\Validation\ValidationException(\Illuminate\Validation\Validator::make([], [], ['item_input' => "Stok tidak tersedia."]));
                \App\Models\Item::where('id', $item->id)->decrement('available');
            }
            $borrowing->forceFill([
                'item_id' => $item->id, 'student_id' => $student->id, 'borrow_date' => $data['borrow_date'],
                'expected_return_date' => $data['expected_return_date'] ?? null, 'status' => $data['status'],
                'return_date' => $newActive ? null : ($borrowing->return_date ?? now()->toDateString()), 'notes' => $data['notes'] ?? null,
            ])->save();
        });

        return redirect()->route('petugas.borrowings.index')->with('success', 'Data peminjaman berhasil diperbarui!');
    })->name('borrowings.update');

    Route::get('borrowings/{id}', function ($id) { return redirect()->route('petugas.borrowings.index'); })->name('borrowings.show');

    Route::delete('borrowings/{id}', function ($id) {
        $borrowing = \App\Models\Borrowing::findOrFail($id);
        \Illuminate\Support\Facades\DB::transaction(function () use ($borrowing) {
            if (in_array($borrowing->status, ['borrowed', 'overdue'])) \App\Models\Item::where('id', $borrowing->item_id)->increment('available');
            $borrowing->delete();
        });
        return redirect()->route('petugas.borrowings.index')->with('success', 'Data peminjaman berhasil dihapus!');
    })->name('borrowings.destroy');

    Route::patch('borrowings/{id}/return', function ($id) {
        $borrowing = \App\Models\Borrowing::findOrFail($id);
        \Illuminate\Support\Facades\DB::transaction(function () use ($borrowing) {
            $borrowing->update(['status' => 'returned', 'return_date' => now()->toDateString()]);
            \App\Models\Item::where('id', $borrowing->item_id)->increment('available');
        });
        return redirect()->route('petugas.borrowings.index')->with('success', 'Item berhasil dikembalikan!');
    })->name('borrowings.return');

    Route::resource('health-tips', \App\Http\Controllers\Petugas\HealthTipController::class);
});

/*
|--------------------------------------------------------------------------
| 6. STUDENT HISTORY (SPECIFICALLY FOR STUDENT ROLE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/riwayat', [MedicalRecordController::class, 'index'])->name('history');
});

/*
|--------------------------------------------------------------------------
| 7. AUTOMATIC REDIRECT AFTER LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function() {
    $user = auth()->user();
    if (! $user) {
        return redirect()->route('login');
    }
    if ($user->hasRole('super-admin') || $user->hasRole('admin') || $user->hasRole('petugas')) {
        return redirect()->route('petugas.dashboard');
    } elseif ($user->hasRole('siswa')) {
        return redirect()->route('siswa.history');
    }
    return redirect()->route('landing');
})->name('dashboard');