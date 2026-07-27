<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Medicine;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil 4 obat yang tersedia untuk ditampilkan di landing page
        $medicines = Medicine::where('status', 'available')->limit(4)->get();
        
        // Data dummy sementara agar tidak error (nanti bisa diganti dengan Model Schedule & Article)
        $schedules = collect([
            (object)['day' => 'Senin - Jumat', 'officer_name' => 'Petugas UKS', 'time' => '07:00 - 15:00']
        ]);
        
        $articles = collect([
            (object)['title' => 'Pentingnya Cuci Tangan', 'excerpt' => 'Cuci tangan adalah langkah sederhana namun sangat efektif mencegah penyakit.'],
            (object)['title' => 'Tips Tetap Sehat di Musim Hujan', 'excerpt' => 'Jaga imunitas tubuh dengan makanan bergizi dan istirahat yang cukup.'],
            (object)['title' => 'Manfaat Olahraga Pagi', 'excerpt' => 'Olahraga pagi dapat meningkatkan konsentrasi belajar siswa di sekolah.']
        ]);
        
        return view('welcome', compact('medicines', 'schedules', 'articles'));
    }

    public function about()
    {
        return view('landing.about');
    }

    public function medicines()
    {
        $medicines = Medicine::where('status', 'available')->paginate(12);
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