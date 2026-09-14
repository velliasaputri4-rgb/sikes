<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Student;
use App\Models\Kelas; 
use App\Models\Medicine;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ExaminationController extends Controller
{
    // Helper untuk mendapatkan data jadwal piket sesuai dokumen
    private function getJadwalPiket()
    {
        return [
            'Kelompok 1' => [
                'Imanuel Avrilliano', 'Kiki Fatmala', 'Cinta Aprilia Rahma', 'Mia Davita Kinanti',
                'Rafika Dwi Amaliatusiva', 'Isnaini Irsaneta Azzahra', 'Nabila Raihani',
                'Muhammad Rava Ulin Nuha', 'Pebriana Dwi Mubarokah', 'Hardiningsih Prabaningrum'
            ],
            'Kelompok 2' => [
                'Aditya Dwi Rama', 'Mahesti Dwi Aqilla', 'Faridatul Hanifah', 'Naysilla Zahra Mutiara',
                'Revika Aisya Zahra', 'Ainun Refatul Sri Utami', 'Anis Zuliani',
                'Muhammad Abdillah Faqih', 'Salma Putri Dwi Az Zahra', 'Hanaya Akni Amalina'
            ],
            'Kelompok 3' => [
                'Ivan Devano Ramadhan', 'Anjani Oktaviana', 'Purwita Khoirun Nabila', 'Audina Nur Kharisma',
                'Fina Kholifatullatifah', 'Kurnia Putri Aulia', 'Sefia Ayu',
                'Rifka Adelia Larasati', 'Ahmad Chrostiyanto', 'Tika Fanesa Putri'
            ],
            'Kelompok 4' => [
                'Muhammad Azriel Hadi Putra', 'Yovinda Ayuandari Oktaferata', 'Fariska Amelya',
                'Kinanti Karisma Yogi Noviana', 'Nur Shinta Al Yahya', 'Rahayu Anggraini Novitasari',
                'Donita Ayu Vega', 'Gandhi SatyaGraha', 'Meisyah Aulia Azzahra', 'Meli Reynata I.Y'
            ],
            'Kelompok 5' => [
                'Muhammad Dimas Prasetya', 'Imeliya Alifatun Zahwa', 'Taqiyya Indee Taher',
                'Mbun Sekar Saifa Adiliya', 'Sweeta Zakiyatul Faizah', 'Firdausil Al Nikmah',
                'Novi Nabila Puspitasari', 'Crista Bella Ratu Ayu Syara', 'Nakeisya Silvi Meidina'
            ],
            'Kelompok 6' => [
                'Qouluki Arif Wakhidin', 'Ticqa Maulaya S.', 'Yossi Shafira Indrasti', 'Nada Zakiya Abdillah',
                'Shelly Zahrotul Jannah', 'Vanessa Putri Ariani', 'Danu Firmasyah',
                'Aprillia Rahma Wati', 'Maidatun Nabilla Masduki'
            ],
        ];
    }

    // ✅ Mendeteksi berdasarkan Route/URL, bukan hanya Role User
    private function getViewPrefix()
    {
        if (request()->routeIs('petugas.*')) {
            return 'petugas';
        }
        if (request()->routeIs('admin.*')) {
            return 'admin';
        }

        $prefix = request()->segment(1);
        if (in_array($prefix, ['admin', 'petugas'])) {
            return $prefix;
        }

        if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))) {
            return 'admin';
        }
        
        return 'petugas';
    }

    private function getRoutePrefix()
    {
        return $this->getViewPrefix();
    }

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

        if ($request->filled('date')) {
            $query->whereDate('examination_date', $request->date);
        }

        $examinations = $query->latest('examination_date')->paginate(15);

        return view($this->getViewPrefix() . '.examinations.index', compact('examinations'));
    }

    public function create()
    {
        $jadwalPiket = $this->getJadwalPiket();
        $medicines = Medicine::where('stock', '>', 0)->orderBy('name', 'asc')->get();
        
        return view($this->getViewPrefix() . '.examinations.create', compact('jadwalPiket', 'medicines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis'              => 'required|string',
            'officer_name'     => 'required|string|max:255',
            'piket_group'      => 'nullable|string|max:255',
            'examination_date' => 'required|date',
            'arrival_time'     => 'required',
            'complaint'        => 'required|string|max:500',
            'diagnosis'        => 'required|string|max:500',
            'medicine'         => 'nullable|string|max:500',
            'status'           => 'required|in:pulang,istirahat_uks,rawat_jalan,rujuk_puskesmas,rujuk_rs,hubungi_ortu',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notes'            => 'nullable|string|max:500',
        ]);

        $student = Student::where('nis', $validated['nis'])->first();
        if (!$student) {
            $request->validate([
                'full_name'  => 'required|string|max:255',
                'class_name' => 'required|string|max:100',
            ], [
                'full_name.required'  => 'NIS tidak terdaftar. Mohon isi nama lengkap untuk siswa baru.',
                'class_name.required' => 'Kelas wajib diisi untuk siswa baru.',
            ]);

            $kelas = Kelas::firstOrCreate(['name' => $request->class_name]);
            $student = Student::create([
                'nis'          => $validated['nis'],
                'full_name'    => $request->full_name,
                'classroom_id' => $kelas->id,
            ]);
        }

        $today = Carbon::now()->format('Ymd');
        $prefix = 'UKS-' . $today . '-';
        
        $lastExam = Examination::where('examination_number', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastExam) {
            $lastNumber = (int) substr($lastExam->examination_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $examNumber = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('examinations', 'public');
        }

        // ✅ PROSES PENGURANGAN STOK OBAT SECARA OTOMATIS
        if (!empty($validated['medicine'])) {
            $this->adjustMedicineStock($validated['medicine'], -1);
        }

        try {
            Examination::create([
                'examination_number' => $examNumber,
                'student_id'         => $student->id,
                'officer_name'       => $validated['officer_name'],
                'piket_group'        => $validated['piket_group'] ?? null,
                'examination_date'   => $validated['examination_date'],
                'arrival_time'       => $validated['arrival_time'] . ':00',
                'complaint'          => $validated['complaint'],
                'diagnosis'          => $validated['diagnosis'],
                'medicine'           => $validated['medicine'],
                'status'             => $validated['status'],
                'notes'              => $validated['notes'],
                'photo'              => $photoPath,
            ]);

            return redirect()->route($this->getRoutePrefix() . '.examinations.index')
                ->with('success', 'Berhasil! No. Pemeriksaan: ' . $examNumber);

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Gagal menyimpan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $examination = Examination::with(['student.class'])->findOrFail($id);
        return view($this->getViewPrefix() . '.examinations.show', compact('examination'));
    }

    public function edit($id)
    {
        $examination = Examination::with('student.class')->findOrFail($id);
        $jadwalPiket = $this->getJadwalPiket();
        $students = Student::with('class')->get();
        $medicines = Medicine::where('stock', '>', 0)->orderBy('name', 'asc')->get();

        return view($this->getViewPrefix() . '.examinations.edit', compact('examination', 'jadwalPiket', 'students', 'medicines'));
    }

    public function update(Request $request, $id)
    {
        $examination = Examination::findOrFail($id);

        $validated = $request->validate([
            'student_id'       => 'required|exists:students,id',
            'officer_name'     => 'required|string|max:255',
            'piket_group'      => 'nullable|string|max:255',
            'examination_date' => 'required|date',
            'arrival_time'     => 'required',
            'complaint'        => 'required|string|max:500',
            'diagnosis'        => 'required|string|max:500',
            'medicine'         => 'nullable|string|max:500',
            'status'           => 'required|in:pulang,istirahat_uks,rawat_jalan,rujuk_puskesmas,rujuk_rs,hubungi_ortu',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notes'            => 'nullable|string|max:500',
        ]);

        $student = Student::find($validated['student_id']);
        if (!$student) {
            return back()->withErrors(['student_id' => 'Siswa tidak ditemukan.'])->withInput();
        }

        $photoPath = $examination->photo;
        if ($request->hasFile('photo')) {
            if ($examination->photo) {
                Storage::disk('public')->delete($examination->photo);
            }
            $photoPath = $request->file('photo')->store('examinations', 'public');
        }

        // ✅ HANDLE PERUBAHAN STOK SAAT DATA DIEDIT
        if ($validated['medicine'] !== $examination->medicine) {
            // 1. Kembalikan stok obat lama
            if (!empty($examination->medicine)) {
                $this->adjustMedicineStock($examination->medicine, 1);
            }
            
            // 2. Kurangi stok obat baru
            if (!empty($validated['medicine'])) {
                $this->adjustMedicineStock($validated['medicine'], -1);
            }
        }

        $examination->update([
            'student_id'       => $student->id,
            'officer_name'     => $validated['officer_name'],
            'piket_group'      => $validated['piket_group'] ?? null,
            'examination_date' => $validated['examination_date'],
            'arrival_time'     => $validated['arrival_time'] . ':00',
            'complaint'        => $validated['complaint'],
            'diagnosis'        => $validated['diagnosis'],
            'medicine'         => $validated['medicine'],
            'status'           => $validated['status'],
            'notes'            => $validated['notes'],
            'photo'            => $photoPath,
        ]);

        return redirect()->route($this->getRoutePrefix() . '.examinations.index')->with('success', 'Data kunjungan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $examination = Examination::findOrFail($id);

        // ✅ KEMBALIKAN STOK OBAT SAAT DATA DIHAPUS
        if (!empty($examination->medicine)) {
            $this->adjustMedicineStock($examination->medicine, 1);
        }

        if ($examination->photo) {
            Storage::disk('public')->delete($examination->photo);
        }

        $examination->delete();

        return redirect()->route($this->getRoutePrefix() . '.examinations.index')->with('success', 'Data kunjungan berhasil dihapus!');
    }

    public function searchStudent($nis)
    {
        $student = Student::with('class')->where('nis', $nis)->first();
        return response()->json($student);
    }

    /**
     * ✅ FITUR BARU: Rekapan dan Statistik Kunjungan
     */
    public function recap(Request $request)
    {
        // ✅ DIPERBAIKI: Pastikan $year dan $month bertipe integer
        $year = (int) $request->input('year', date('Y'));
        $month = $request->input('month') ? (int) $request->input('month') : null;
        
        $query = Examination::with(['student.class']);
        $query->whereYear('examination_date', $year);
        
        if ($month) {
            $query->whereMonth('examination_date', $month);
        }
        
        $examinations = $query->get();
        
        // 1. Top 5 Penyakit Paling Sering
        $topDiagnoses = Examination::selectRaw('diagnosis, COUNT(*) as count')
            ->whereYear('examination_date', $year)
            ->when($month, function($q) use ($month) {
                return $q->whereMonth('examination_date', $month);
            })
            ->groupBy('diagnosis')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
        
        // 2. Top 5 Obat Paling Sering Diberikan
        $topMedicines = Examination::selectRaw('medicine, COUNT(*) as count')
            ->whereYear('examination_date', $year)
            ->when($month, function($q) use ($month) {
                return $q->whereMonth('examination_date', $month);
            })
            ->whereNotNull('medicine')
            ->where('medicine', '!=', '')
            ->groupBy('medicine')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
        
        // 3. Top 5 Siswa Paling Sering Sakit
        $topSickStudents = Examination::with(['student.class'])
            ->selectRaw('student_id, COUNT(*) as count')
            ->whereYear('examination_date', $year)
            ->when($month, function($q) use ($month) {
                return $q->whereMonth('examination_date', $month);
            })
            ->groupBy('student_id')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
        
        // 4. Statistik Status Kepulangan
        $statusStats = Examination::selectRaw('status, COUNT(*) as count')
            ->whereYear('examination_date', $year)
            ->when($month, function($q) use ($month) {
                return $q->whereMonth('examination_date', $month);
            })
            ->groupBy('status')
            ->get();
        
        // 5. Total Kunjungan per Bulan (untuk grafik) - ✅ DIPERBAIKI
        $monthlyStats = [];
        for ($m = 1; $m <= 12; $m++) {
            $count = Examination::whereYear('examination_date', $year)
                ->whereMonth('examination_date', $m)
                ->count();
            $monthlyStats[] = [
                // ✅ Menggunakan createFromDate agar aman di Carbon 3.x
                'month' => Carbon::createFromDate($year, $m, 1)->format('F'),
                'count' => $count
            ];
        }
        
        // 6. Statistik per Kelas (Top 10)
        $classStats = Examination::selectRaw('classroom_id, COUNT(*) as count')
            ->join('students', 'examinations.student_id', '=', 'students.id')
            ->whereYear('examinations.examination_date', $year)
            ->when($month, function($q) use ($month) {
                return $q->whereMonth('examinations.examination_date', $month);
            })
            ->groupBy('classroom_id')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
        
        // Total kunjungan
        $totalVisits = $examinations->count();
        
        // Daftar tahun untuk filter
        $years = Examination::selectRaw('YEAR(examination_date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');
        
        return view($this->getViewPrefix() . '.examinations.recap', compact(
            'year', 'month', 'years', 'totalVisits', 'topDiagnoses', 
            'topMedicines', 'topSickStudents', 'statusStats', 'monthlyStats', 'classStats'
        ));
    }

    /**
     * ✅ FUNGSI HELPER: Menyesuaikan stok obat berdasarkan string input
     * 
     * @param string $medicineString (Contoh: "Paracetamol 500mg (2 tablet)")
     * @param int $adjustment (1 untuk menambah/kembali, -1 untuk mengurangi)
     */
    private function adjustMedicineStock($medicineString, $adjustment)
    {
        if (empty($medicineString)) {
            return;
        }

        $medicines = Medicine::all();
        $matchedMedicine = null;
        $quantity = 1; // Default 1 jika jumlah tidak terdeteksi

        foreach ($medicines as $med) {
            // Cek apakah nama obat ada di dalam string input (case-insensitive)
            if (stripos($medicineString, $med->name) !== false) {
                $matchedMedicine = $med;
                
                // Coba ekstrak jumlah dari string menggunakan Regex
                // Mencari angka yang diikuti oleh satuan umum (tablet, kapsul, botol, dll)
                if (preg_match('/\(?(\d+)\s*(?:tablet|kapsul|botol|sachet|tube|pcs|strip)\)?/i', $medicineString, $matches)) {
                    $quantity = (int)$matches[1];
                }
                
                break; // Hentikan loop setelah menemukan kecocokan pertama
            }
        }

        if ($matchedMedicine) {
            $newStock = $matchedMedicine->stock + ($adjustment * $quantity);
            
            // Pastikan stok tidak minus
            if ($newStock < 0) {
                $newStock = 0;
            }

            // Tentukan status baru secara otomatis
            $status = 'available';
            if ($newStock == 0) {
                $status = 'empty';
            } elseif ($newStock <= $matchedMedicine->minimum_stock) {
                $status = 'low_stock';
            }

            // Update database
            $matchedMedicine->update([
                'stock' => $newStock,
                'status' => $status
            ]);
        }
    }
}