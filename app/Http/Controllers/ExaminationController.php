<?php

namespace App\Http\Controllers;

use App\Models\{Examination, Student, Medicine};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ExaminationController extends Controller
{
    // ... (method index tetap sama) ...

    public function create()
    {
        // Ambil semua siswa untuk dropdown, urutkan berdasarkan nama
        $students = Student::with('class')->orderBy('full_name')->get();
        
        // Pastikan return ke view petugas
        return view('petugas.examinations.create', compact('students'));
    }

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

        // Generate Nomor Pemeriksaan Unik (Contoh: UKS-20231025-0001)
        $examNumber = 'UKS-' . Carbon::now()->format('Ymd') . '-' . 
                      str_pad(Examination::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        // Hitung BMI otomatis jika berat dan tinggi badan diisi
        $bmi = null;
        if ($request->weight && $request->height) {
            $heightInMeters = $request->height / 100;
            $bmi = round($request->weight / ($heightInMeters * $heightInMeters), 2);
        }

        // Upload Foto Dokumentasi
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('examinations', 'public');
        }

        // Simpan ke Database
        Examination::create([
            'examination_number' => $examNumber,
            'student_id' => $validated['student_id'],
            'officer_id' => auth()->id(), // Menggunakan ID user yang sedang login
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

        return redirect()->route('petugas.examinations.index')
                         ->with('success', 'Data kunjungan siswa berhasil disimpan!');
    }

    // ... (method show, edit, update, destroy bisa ditambahkan nanti) ...
}