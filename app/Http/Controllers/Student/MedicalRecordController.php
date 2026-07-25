<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Pastikan user memiliki data siswa
        if (!$user->student) {
            return redirect()->route('dashboard')->with('error', 'Data profil siswa tidak ditemukan.');
        }

        $student = $user->student;

        // Ambil riwayat pemeriksaan milik siswa ini, urutkan dari yang terbaru
        $examinations = Examination::where('student_id', $student->id)
            ->with(['officer.user']) // Load data petugas yang menangani
            ->latest('examination_date')
            ->paginate(10);

        return view('student.medical-record', compact('student', 'examinations'));
    }
}