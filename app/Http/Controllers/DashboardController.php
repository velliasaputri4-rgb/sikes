<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Examination;
use App\Models\Medicine;
use App\Models\User;

class DashboardController extends Controller
{
    // Dashboard Admin
    public function adminIndex()
    {
        $data = [
            'total_siswa'     => Student::count(),
            'total_petugas'   => User::role('petugas')->count(),
            'exams_today'     => Examination::whereDate('examination_date', today())->count(),
            'exams_month'     => Examination::whereMonth('examination_date', now()->month)->count(),
            'low_stock'       => Medicine::whereColumn('stock', '<=', 'minimum_stock')->count(),
            'total_medicines' => Medicine::sum('stock'),
        ];

        return view('admin.dashboard', $data);
    }

    // Dashboard Petugas
    public function petugasIndex()
    {
        $data = [
            'exams_today'     => Examination::whereDate('examination_date', today())->count(),
            'exams_month'     => Examination::whereMonth('examination_date', now()->month)->count(),
            'low_stock'       => Medicine::whereColumn('stock', '<=', 'minimum_stock')->count(),
        ];

        return view('petugas.dashboard', $data);
    }
}