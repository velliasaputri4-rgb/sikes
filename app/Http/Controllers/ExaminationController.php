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

    // ✅ HELPER: Menentukan prefix view berdasarkan role (admin atau petugas)
    private function getViewPrefix()
    {
        if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))) {
            return 'admin';
        }
        return 'petugas';
    }

    // ✅ HELPER: Menentukan prefix route berdasarkan role (admin atau petugas)
    private function getRoutePrefix()
    {
        if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))) {
            return 'admin';
        }
        return 'petugas';
    }

    // 1. Menampilkan Daftar Kunjungan
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

        // ✅ Otomatis memilih view: admin.examinations.index ATAU petugas.examinations.index
        return view($this->getViewPrefix() . '.examinations.index', compact('examinations'));
    }

    // 2. Menampilkan Form Tambah Kunjungan
    public function create()
    {
        $jadwalPiket = $this->getJadwalPiket();
        return view($this->getViewPrefix() . '.examinations.create', compact('jadwalPiket'));
    }

    // 3. Menyimpan Data Kunjungan Baru
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

        $examNumber = 'UKS-' . Carbon::now()->format('Ymd') . '-' .
                      str_pad(Examination::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('examinations', 'public');
        }

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

        // ✅ Otomatis redirect ke route yang sesuai role
        return redirect()->route($this->getRoutePrefix() . '.examinations.index')->with('success', 'Data kunjungan berhasil disimpan!');
    }

    // 4. Menampilkan Detail Kunjungan
    public function show($id)
    {
        $examination = Examination::with(['student.class'])->findOrFail($id);
        return view($this->getViewPrefix() . '.examinations.show', compact('examination'));
    }

    // 5. Menampilkan Form Edit
    public function edit($id)
    {
        $examination = Examination::with('student.class')->findOrFail($id);
        $jadwalPiket = $this->getJadwalPiket();
        $students = Student::with('class')->get();

        return view($this->getViewPrefix() . '.examinations.edit', compact('examination', 'jadwalPiket', 'students'));
    }

    // 6. Update Data Kunjungan
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

        // ✅ Otomatis redirect ke route yang sesuai role
        return redirect()->route($this->getRoutePrefix() . '.examinations.index')->with('success', 'Data kunjungan berhasil diperbarui!');
    }

    // 7. Hapus Data Kunjungan
    public function destroy($id)
    {
        $examination = Examination::findOrFail($id);

        if ($examination->photo) {
            Storage::disk('public')->delete($examination->photo);
        }

        $examination->delete();

        // ✅ Otomatis redirect ke route yang sesuai role
        return redirect()->route($this->getRoutePrefix() . '.examinations.index')->with('success', 'Data kunjungan berhasil dihapus!');
    }

    // METHOD BARU untuk AJAX cari siswa by NIS
    public function searchStudent($nis)
    {
        $student = Student::with('class')->where('nis', $nis)->first();
        return response()->json($student);
    }
}