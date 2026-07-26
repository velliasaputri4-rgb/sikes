<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExaminationController extends Controller
{
    // 1. Menampilkan Daftar Kunjungan
    public function index(Request $request)
    {
        $query = Examination::with(['student.user', 'student.class']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('examination_date', $request->date);
        }

        $examinations = $query->latest('examination_date')->paginate(15);

        // KITA PAKAI VIEW PETUGAS UNTUK SEMUA AGAR TIDAK PERLU BUAT FILE GANDA
        return view('petugas.examinations.index', compact('examinations'));
    }

    // 2. Menampilkan Form Tambah Kunjungan
    public function create()
    {
        $students = Student::with('class')->orderBy('full_name')->get();
        return view('petugas.examinations.create', compact('students'));
    }

    // 3. Menyimpan Data Kunjungan Baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'complaint' => 'required|string|max:500',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'blood_pressure' => 'nullable|string|max:20',
            'pulse' => 'nullable|integer|min:30|max:200',
            'weight' => 'nullable|numeric|min:1|max:200',
            'height' => 'nullable|numeric|min:50|max:250',
            'diagnosis' => 'required|string|max:500',
            'treatment' => 'nullable|string|max:500',
            'status' => 'required|in:pulang,istirahat_uks,rawat_jalan,rujuk_puskesmas,rujuk_rs',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notes' => 'nullable|string|max:500',
        ]);

        $examNumber = 'UKS-' . Carbon::now()->format('Ymd') . '-' . 
                      str_pad(Examination::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $bmi = null;
        if ($request->weight && $request->height) {
            $heightInMeters = $request->height / 100;
            $bmi = round($request->weight / ($heightInMeters * $heightInMeters), 2);
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('examinations', 'public');
        }

        Examination::create([
            'examination_number' => $examNumber,
            'student_id' => $validated['student_id'],
            'officer_id' => auth()->id(),
            'examination_date' => now(),
            'arrival_time' => now()->format('H:i:s'),
            'complaint' => $validated['complaint'],
            'temperature' => $validated['temperature'],
            'blood_pressure' => $validated['blood_pressure'],
            'pulse' => $validated['pulse'],
            'weight' => $validated['weight'],
            'height' => $validated['height'],
            'bmi' => $bmi,
            'diagnosis' => $validated['diagnosis'],
            'treatment' => $validated['treatment'],
            'status' => $validated['status'],
            'notes' => $validated['notes'],
            'photo' => $photoPath,
        ]);

        // Redirect ke halaman index (otomatis menyesuaikan role)
        if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.examinations.index')->with('success', 'Data kunjungan berhasil disimpan!');
        }

        return redirect()->route('petugas.examinations.index')->with('success', 'Data kunjungan berhasil disimpan!');
    }

    // 4. Menampilkan Detail Kunjungan
    public function show($id)
    {
        $examination = Examination::with(['student.class', 'officer.user'])->findOrFail($id);
        return view('petugas.examinations.show', compact('examination'));
    }

    // 5. Menampilkan Form Edit
    public function edit($id)
    {
        $examination = Examination::findOrFail($id);
        $students = Student::with('class')->orderBy('full_name')->get();
        return view('petugas.examinations.edit', compact('examination', 'students'));
    }

    // 6. Update Data Kunjungan
    public function update(Request $request, $id)
    {
        $examination = Examination::findOrFail($id);
        
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'complaint' => 'required|string|max:500',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'blood_pressure' => 'nullable|string|max:20',
            'pulse' => 'nullable|integer|min:30|max:200',
            'weight' => 'nullable|numeric|min:1|max:200',
            'height' => 'nullable|numeric|min:50|max:250',
            'diagnosis' => 'required|string|max:500',
            'treatment' => 'nullable|string|max:500',
            'status' => 'required|in:pulang,istirahat_uks,rawat_jalan,rujuk_puskesmas,rujuk_rs',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notes' => 'nullable|string|max:500',
        ]);

        $bmi = null;
        if ($request->weight && $request->height) {
            $heightInMeters = $request->height / 100;
            $bmi = round($request->weight / ($heightInMeters * $heightInMeters), 2);
        }

        $photoPath = $examination->photo;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('examinations', 'public');
        }

        $examination->update([
            'student_id' => $validated['student_id'],
            'complaint' => $validated['complaint'],
            'temperature' => $validated['temperature'],
            'blood_pressure' => $validated['blood_pressure'],
            'pulse' => $validated['pulse'],
            'weight' => $validated['weight'],
            'height' => $validated['height'],
            'bmi' => $bmi,
            'diagnosis' => $validated['diagnosis'],
            'treatment' => $validated['treatment'],
            'status' => $validated['status'],
            'notes' => $validated['notes'],
            'photo' => $photoPath,
        ]);

        if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.examinations.index')->with('success', 'Data kunjungan berhasil diperbarui!');
        }

        return redirect()->route('petugas.examinations.index')->with('success', 'Data kunjungan berhasil diperbarui!');
    }

    // 7. Hapus Data Kunjungan
    public function destroy($id)
    {
        $examination = Examination::findOrFail($id);
        $examination->delete();

        if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.examinations.index')->with('success', 'Data kunjungan berhasil dihapus!');
        }

        return redirect()->route('petugas.examinations.index')->with('success', 'Data kunjungan berhasil dihapus!');
    }
}