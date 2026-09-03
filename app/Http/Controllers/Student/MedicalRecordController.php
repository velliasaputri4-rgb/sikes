<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // Ambil riwayat pemeriksaan siswa
        $examinations = Examination::where('student_id', $student->id)
            ->with(['student.class']) 
            ->latest('examination_date')
            ->paginate(10);

        // ✅ FITUR BARU: Statistik Frekuensi Kunjungan (3 Tahun Terakhir)
        $threeYearsAgo = Carbon::now()->subYears(3)->startOfMonth();
        
        $monthlyVisits = DB::table('examinations')
            ->where('student_id', $student->id)
            ->where('examination_date', '>=', $threeYearsAgo)
            ->select(
                DB::raw('YEAR(examination_date) as year'),
                DB::raw('MONTH(examination_date) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Hitung total dan rata-rata
        $totalVisits3Years = $monthlyVisits->sum('count');
        $averagePerMonth = $totalVisits3Years > 0 ? round($totalVisits3Years / 36, 1) : 0;

        // Format data agar mudah dibaca di Blade (Contoh: "Januari 2024")
        $visitStats = [];
        foreach ($monthlyVisits as $stat) {
            $visitStats[] = [
                'period' => Carbon::createFromDate($stat->year, $stat->month, 1)->locale('id')->isoFormat('MMMM YYYY'),
                'count'  => $stat->count,
            ];
        }

        // Kirim semua variabel ke view 'student.medical-record'
        return view('student.medical-record', compact(
            'student', 
            'examinations', 
            'visitStats', 
            'totalVisits3Years', 
            'averagePerMonth'
        ));
    }
}