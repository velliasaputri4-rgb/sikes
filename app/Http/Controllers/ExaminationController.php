<?php

namespace App\Http\Controllers;

use App\Models\{Examination, Student, Medicine, Officer};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ExaminationController extends Controller
{
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

        $examinations = $query->latest()->paginate(10);
        return view('examinations.index', compact('examinations'));
    }

    public function create()
    {
        $students = Student::with('class')->orderBy('full_name')->get();
        return view('examinations.create', compact('students'));
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

        // Generate Nomor Pemeriksaan & Token QR
        $examNumber = 'UKS-' . Carbon::now()->format('Ymd') . '-' . str_pad(Examination::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
        $qrToken = Str::random(64);

        // Hitung BMI
        $bmi = null;
        if ($request->weight && $request->height) {
            $heightInMeters = $request->height / 100;
            $bmi = round($request->weight / ($heightInMeters * $heightInMeters), 2);
        }

        // Upload Foto
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('examinations', 'public');
        }

        // Simpan Data
        Examination::create([
            'examination_number' => $examNumber,
            'student_id' => $validated['student_id'],
            'officer_id' => auth()->user()->officer?->id ?? 1, // Fallback jika tidak ada data officer
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
            'qr_token' => $qrToken,
            'photo' => $photoPath,
        ]);

        return redirect()->route('examinations.index')->with('success', 'Data kunjungan berhasil disimpan!');
    }

    public function show($id) { return view('examinations.show'); }
    public function edit($id) { return view('examinations.edit'); }
    public function update(Request $request, $id) { /* Logic update */ }
    public function destroy($id) { /* Logic delete */ }
}