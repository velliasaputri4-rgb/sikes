<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        // 1. Ambil 4 obat yang tersedia untuk ditampilkan di landing page
        $medicines = Medicine::where('status', 'available')->limit(4)->get();
        
        // 2. Data jadwal (pakai Model Schedule)
        $schedules = \App\Models\Schedule::orderBy('id')->get();
        
        // 3. Data artikel dummy sementara
        $articles = collect([
            (object)['title' => 'Pentingnya Cuci Tangan', 'excerpt' => 'Cuci tangan adalah langkah sederhana namun sangat efektif mencegah penyakit.'],
            (object)['title' => 'Tips Tetap Sehat di Musim Hujan', 'excerpt' => 'Jaga imunitas tubuh dengan makanan bergizi dan istirahat yang cukup.'],
            (object)['title' => 'Manfaat Olahraga Pagi', 'excerpt' => 'Olahraga pagi dapat meningkatkan konsentrasi belajar siswa di sekolah.']
        ]);

        // 4. ✅ DATA STATISTIK REAL-TIME
        // Jumlah siswa terdaftar (aktif)
        $totalStudents = DB::table('students')
            ->whereNull('deleted_at')
            ->count();

        // Kunjungan hari ini
        $examsToday = DB::table('examinations')
            ->whereDate('examination_date', Carbon::today())
            ->count();

        // Total kunjungan bulan ini
        $examsMonth = DB::table('examinations')
            ->whereMonth('examination_date', Carbon::now()->month)
            ->whereYear('examination_date', Carbon::now()->year)
            ->count();

        // Persentase layanan optimal
        $totalExamsMonth = DB::table('examinations')
            ->whereMonth('examination_date', Carbon::now()->month)
            ->whereYear('examination_date', Carbon::now()->year)
            ->count();

        $healthyExams = DB::table('examinations')
            ->whereMonth('examination_date', Carbon::now()->month)
            ->whereYear('examination_date', Carbon::now()->year)
            ->whereNotIn('status', ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs'])
            ->count();

        $optimalPercentage = $totalExamsMonth > 0 
            ? round(($healthyExams / $totalExamsMonth) * 100) 
            : 100;
        
        return view('welcome', compact(
            'medicines', 
            'schedules', 
            'articles',
            'totalStudents',
            'examsToday',
            'examsMonth',
            'optimalPercentage'
        ));
    }

    public function about()
    {
        return view('landing.about');
    }

    public function medicines()
    {
        $medicines = \App\Models\Medicine::with('category')
            ->where('stock', '>', 0)
            ->whereNotIn('status', ['expired', 'empty'])
            ->orderBy('name')
            ->paginate(12);

        return view('landing.medicines', compact('medicines'));
    }

    public function schedule()
    {
        $schedules = \App\Models\Schedule::orderBy('id')->get();
        return view('landing.schedule', compact('schedules'));
    }

    public function contact()
    {
        return view('landing.contact');
    }
}