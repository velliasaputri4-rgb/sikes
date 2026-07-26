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
        
        // Pastikan user adalah siswa dan memiliki data student
        if (!$user->hasRole('siswa') || !$user->student) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk siswa.');
        }

        $student = $user->student;

        // Ambil HANYA riwayat pemeriksaan milik siswa yang sedang login
        $examinations = Examination::where('student_id', $student->id)
            ->with(['officer.user'])
            ->latest('examination_date')
            ->paginate(10);

        return view('student.medical-record', compact('student', 'examinations'));
    }
}