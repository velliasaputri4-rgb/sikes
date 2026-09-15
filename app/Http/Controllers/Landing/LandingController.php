<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Setting;
use App\Models\HealthTip;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        // 1. Ambil 4 obat yang tersedia untuk ditampilkan di landing page
        $medicines = Medicine::where('status', 'available')->limit(4)->get();
        
        // 2. Data jadwal
        $schedules = \App\Models\Schedule::orderBy('id')->get();
        
        // 3. ✅ HITUNG ANGGOTA PMR (Tahan terhadap casting array)
        $uniquePmrMembers = [];
        foreach ($schedules as $schedule) {
            $membersRaw = $schedule->members ?? '[]';
            $members = is_string($membersRaw) ? json_decode($membersRaw, true) : $membersRaw;
            
            if (is_array($members)) {
                foreach ($members as $member) {
                    $memberName = is_array($member) ? ($member['name'] ?? '') : $member;
                    if (!empty($memberName) && !in_array(trim($memberName), $uniquePmrMembers)) {
                        $uniquePmrMembers[] = trim($memberName);
                    }
                }
            }
        }
        $pmrMembersCount = count($uniquePmrMembers);

        // 4. ✅ DATA DOKUMENTASI/BERITA (Dipastikan berupa OBJEK agar $doc->image works di Blade)
        $rawDocs = Setting::where('key', 'documentations_data')->value('value') ?? '[]';
        
        // Decode tanpa 'true' agar hasilnya berupa objek (stdClass), bukan array
        $decodedDocs = is_string($rawDocs) ? json_decode($rawDocs) : $rawDocs;
        
        // Konversi ke objek jika ternyata berupa array (untuk antisipasi casting model Laravel)
        if (is_array($decodedDocs)) {
            $decodedDocs = array_map(fn($item) => is_array($item) ? (object) $item : $item, $decodedDocs);
        }
        
        $allDocumentations = collect($decodedDocs);
        $documentations = $allDocumentations->sortByDesc('published_at')->take(3)->values();

        // 5. ✅ DATA STATISTIK REAL-TIME (DIPERBAIKI: Mengabaikan data yang sudah di-soft delete)
        $totalStudents = DB::table('students')->whereNull('deleted_at')->count();

        $examsToday = DB::table('examinations')
            ->whereDate('examination_date', Carbon::today())
            ->whereNull('deleted_at') // ✅ Abaikan data yang sudah dihapus
            ->count();

        $examsMonth = DB::table('examinations')
            ->whereMonth('examination_date', Carbon::now()->month)
            ->whereYear('examination_date', Carbon::now()->year)
            ->whereNull('deleted_at') // ✅ Abaikan data yang sudah dihapus
            ->count();

        $totalExamsMonth = $examsMonth;

        $healthyExams = DB::table('examinations')
            ->whereMonth('examination_date', Carbon::now()->month)
            ->whereYear('examination_date', Carbon::now()->year)
            ->whereNull('deleted_at') // ✅ Abaikan data yang sudah dihapus
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
            'optimalPercentage',
            'pmrMembersCount'
        ));
    }

    public function about()
    {
        return view('landing.about');
    }

    public function services()
    {
        return view('landing.services');
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
        $healthTips = HealthTip::latest()->paginate(9);
        return view('landing.health-info', compact('healthTips'));
    }

    // ✅ Method untuk halaman Daftar Dokumentasi/Berita
    public function docs()
    {
        $rawDocs = Setting::where('key', 'documentations_data')->value('value') ?? '[]';
        $decodedDocs = is_string($rawDocs) ? json_decode($rawDocs) : $rawDocs;
        
        if (is_array($decodedDocs)) {
            $decodedDocs = array_map(fn($item) => is_array($item) ? (object) $item : $item, $decodedDocs);
        }
        
        $allDocumentations = collect($decodedDocs);
        $documentations = $allDocumentations->sortByDesc('published_at')->values();
            
        return view('landing.docs', compact('documentations'));
    }

    // ✅ Method untuk Detail Dokumentasi
    public function docsDetail($slug)
    {
        $rawDocs = Setting::where('key', 'documentations_data')->value('value') ?? '[]';
        $decodedDocs = is_string($rawDocs) ? json_decode($rawDocs) : $rawDocs;
        
        if (is_array($decodedDocs)) {
            $decodedDocs = array_map(fn($item) => is_array($item) ? (object) $item : $item, $decodedDocs);
        }
        
        $allDocumentations = collect($decodedDocs);
        
        $doc = $allDocumentations->first(function ($item) use ($slug) {
            return Str::slug($item->title) === $slug;
        });

        if (!$doc) {
            abort(404, 'Dokumentasi tidak ditemukan');
        }
        
        return view('landing.docs-detail', compact('doc'));
    }
}