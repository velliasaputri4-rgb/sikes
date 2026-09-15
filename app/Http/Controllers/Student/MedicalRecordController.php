<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use Illuminate\Http\Request;
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

        // 1. Ambil riwayat pemeriksaan siswa (dengan pagination)
        $examinations = Examination::where('student_id', $student->id)
            ->with(['student.class']) 
            ->latest('examination_date')
            ->paginate(10);

        // 2. ✅ FITUR STATISTIK: Frekuensi Kunjungan (3 Tahun Terakhir)
        $threeYearsAgo = Carbon::now()->subYears(3)->startOfMonth();
        
        // PERBAIKAN KRUSIAL: Gunakan Model Examination, BUKAN DB::table
        // Ini memastikan data yang sudah di-soft delete TIDAK ikut terhitung
        $monthlyVisits = Examination::where('student_id', $student->id)
            ->where('examination_date', '>=', $threeYearsAgo)
            ->selectRaw('YEAR(examination_date) as year, MONTH(examination_date) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // 3. Hitung total dan rata-rata
        $totalVisits3Years = $monthlyVisits->sum('count');
        $averagePerMonth = $totalVisits3Years > 0 ? round($totalVisits3Years / 36, 1) : 0;

        // 4. Format data agar mudah dibaca di Blade (Contoh: "Januari 2024")
        $visitStats = [];
        foreach ($monthlyVisits as $stat) {
            $visitStats[] = [
                'period' => Carbon::createFromDate($stat->year, $stat->month, 1)->locale('id')->isoFormat('MMMM YYYY'),
                'count'  => $stat->count,
            ];
        }

        // 🔍 DEBUGGING (Opsional): 
        // Jika masih belum terupdate, hilangkan tanda komentar (//) di baris bawah ini 
        // untuk melihat apakah data benar-benar sampai ke controller.
        // dd($totalVisits3Years, $averagePerMonth, $visitStats);

        // 5. Kirim semua variabel ke view
        return view('student.medical-record', compact(
            'student', 
            'examinations', 
            'visitStats', 
            'totalVisits3Years', 
            'averagePerMonth'
        ));
    }
}