<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Setting; // ✅ Ganti import Documentation dengan Setting
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        // 1. Ambil 4 obat yang tersedia untuk ditampilkan di landing page
        $medicines = Medicine::where('status', 'available')->limit(4)->get();
        
        // 2. Data jadwal (pakai Model Schedule)
        $schedules = \App\Models\Schedule::orderBy('id')->get();
        
        // 3. ✅ DATA DOKUMENTASI/BERITA (Dibaca dari Setting JSON sebagai Object)
        $docsJson = Setting::where('key', 'documentations_data')->value('value') ?? '[]';
        $allDocumentations = collect(json_decode($docsJson)); // Decode sebagai object agar $doc->title tetap bisa dipakai di Blade
        
        // Urutkan berdasarkan tanggal turun (terbaru dulu) dan ambil maksimal 3
        $documentations = $allDocumentations->sortByDesc('published_at')->take(3)->values();

        // 4. ✅ DATA STATISTIK REAL-TIME
        $totalStudents = DB::table('students')->whereNull('deleted_at')->count();

        $examsToday = DB::table('examinations')
            ->whereDate('examination_date', Carbon::today())
            ->count();

        $examsMonth = DB::table('examinations')
            ->whereMonth('examination_date', Carbon::now()->month)
            ->whereYear('examination_date', Carbon::now()->year)
            ->count();

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
            'documentations', 
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
        $medicines = Medicine::where('stock', '>', 0)
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

    public function healthInfo()
    {
        return view('landing.health-info');
    }

    // ✅ Method untuk halaman Daftar Dokumentasi/Berita (Semua dari JSON)
    public function docs()
    {
        $docsJson = Setting::where('key', 'documentations_data')->value('value') ?? '[]';
        $allDocumentations = collect(json_decode($docsJson));
        
        // Urutkan berdasarkan tanggal turun
        $documentations = $allDocumentations->sortByDesc('published_at')->values();
            
        return view('landing.docs', compact('documentations'));
    }

    // ✅ Method untuk Detail Dokumentasi (Mencari berdasarkan slug judul)
    public function docsDetail($slug)
    {
        $docsJson = Setting::where('key', 'documentations_data')->value('value') ?? '[]';
        $allDocumentations = collect(json_decode($docsJson));
        
        // Cari dokumen yang slug judulnya cocok dengan URL
        $doc = $allDocumentations->first(function ($item) use ($slug) {
            return Str::slug($item->title) === $slug;
        });

        if (!$doc) {
            abort(404, 'Dokumentasi tidak ditemukan');
        }
        
        return view('landing.docs-detail', compact('doc'));
    }
}