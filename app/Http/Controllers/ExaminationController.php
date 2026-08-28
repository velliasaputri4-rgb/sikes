<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Student;
use App\Models\Kelas; 
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

    private function getViewPrefix()
    {
        if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))) {
            return 'admin';
        }
        return 'petugas';
    }

    private function getRoutePrefix()
    {
        if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))) {
            return 'admin';
        }
        return 'petugas';
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
        return view($this->getViewPrefix() . '.examinations.create', compact('jadwalPiket'));
    }

    // ✅ METHOD STORE YANG SUDAH DIPERBAIKI (MENGGUNAKAN ID UNTUK PENOMORAN)
    public function store(Request $request)
    {
        // 1. Validasi Input
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

        // 2. Cek atau Buat Data Siswa
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

        // 3. ✅ GENERATE NOMOR PEMERIKSAAN (LOGIKA BARU - PAKAI ID AGAR PASTI)
        $today = Carbon::now()->format('Ymd');
        $prefix = 'UKS-' . $today . '-';
        
        // Cari data terakhir hari ini berdasarkan ID (paling baru)
        $lastExam = Examination::where('examination_number', 'like', $prefix . '%')
            ->orderBy('id', 'desc') // ✅ Menggunakan ID yang selalu unik dan berurutan
            ->first();
        
        if ($lastExam) {
            // Ambil 4 digit terakhir dari nomor pemeriksaan, ubah ke angka, tambah 1
            $lastNumber = (int) substr($lastExam->examination_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            // Jika belum ada data hari ini, mulai dari 1
            $newNumber = 1;
        }
        
        // Format jadi 4 digit (0001, 0002, dst)
        $examNumber = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        // 4. Upload Foto (Jika Ada)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('examinations', 'public');
        }

        // 5. Simpan ke Database
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

        return view($this->getViewPrefix() . '.examinations.edit', compact('examination', 'jadwalPiket', 'students'));
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
            $photoPath = $request->file('photo')->store('examinations', 'public');
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
}