<?php

namespace App\Http\Controllers;

use App\Models\{Student, User, ClassRoom};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['user', 'class']);

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->paginate(10)->withQueryString();
        $classes = ClassRoom::orderBy('name')->get();

        return view('admin.students.index', compact('students', 'classes'));
    }

    public function create()
    {
        $classes = ClassRoom::orderBy('name')->get();
        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:students,nis',
            'full_name' => 'required|string|max:100',
            'class_name' => 'required|string|max:50',
            'birth_date' => 'required|date',
            'gender' => 'nullable|in:L,P',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nis.unique' => 'NIS tersebut sudah terdaftar di database.',
            'class_name.required' => 'Kelas wajib diisi (pilih atau ketik kelas baru).',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
        ]);

        DB::beginTransaction();
        try {
            // 2. Upload Foto (Jika ada)
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('students', 'public');
            }

            // 3. Cari atau Buat Kelas Baru
            $className = trim($validated['class_name']);
            $class = ClassRoom::where('name', $className)->first();

            if (!$class) {
                $cleanName = strtoupper(preg_replace('/[^A-Za-z0-9]/', '_', $className));
                $class = ClassRoom::create([
                    'name' => $className,
                    'code' => $cleanName . '_' . time(),
                ]);
            }

            // 4. Buat Akun User untuk Siswa
            $defaultPassword = $validated['nis'] . str_replace('-', '', $validated['birth_date']);
            
            $user = User::create([
                'name' => $validated['full_name'],
                'email' => $validated['nis'] . '@sikes.sch.id',
                'password' => Hash::make($defaultPassword),
                'phone' => $validated['parent_phone'] ?? null,
                'photo' => $photoPath,
                'status' => 'active',
            ]);
            
            $user->assignRole('siswa');

            // 5. Buat Data Siswa
            // ✅ PERBAIKAN: Gunakan 'classroom_id' bukan 'class_id'
            Student::create([
                'user_id' => $user->id,
                'classroom_id' => $class->id,
                'nis' => $validated['nis'],
                'full_name' => $validated['full_name'],
                'gender' => $validated['gender'] ?? 'L',
                'birth_date' => $validated['birth_date'],
                'address' => $validated['address'] ?? null,
                'parent_phone' => $validated['parent_phone'] ?? null,
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Data siswa dan akun berhasil dibuat! Password default: ' . $defaultPassword);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = ClassRoom::orderBy('name')->get();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        // 1. Validasi Input
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:students,nis,' . $id,
            'full_name' => 'required|string|max:100',
            'class_name' => 'required|string|max:50',
            'birth_date' => 'required|date',
            'gender' => 'nullable|in:L,P',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // 2. Upload Foto Baru (Jika ada)
            if ($request->hasFile('photo')) {
                if ($student->user && $student->user->photo) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($student->user->photo);
                }
                $photoPath = $request->file('photo')->store('students', 'public');
                $student->user->update(['photo' => $photoPath]);
            }

            // 3. Cari atau Buat Kelas Baru
            $className = trim($validated['class_name']);
            $class = ClassRoom::where('name', $className)->first();

            if (!$class) {
                $cleanName = strtoupper(preg_replace('/[^A-Za-z0-9]/', '_', $className));
                $class = ClassRoom::create([
                    'name' => $className,
                    'code' => $cleanName . '_' . time(),
                ]);
            }

            // 4. Update Data Siswa
            // ✅ PERBAIKAN: Gunakan 'classroom_id' bukan 'class_id'
            $student->update([
                'nis' => $validated['nis'],
                'full_name' => $validated['full_name'],
                'classroom_id' => $class->id,
                'gender' => $validated['gender'] ?? $student->gender,
                'birth_date' => $validated['birth_date'],
                'address' => $validated['address'] ?? null,
                'parent_phone' => $validated['parent_phone'] ?? null,
            ]);

            // 5. Update Nama User jika berubah
            if ($student->user) {
                $student->user->update(['name' => $validated['full_name']]);
            }

            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        
        DB::beginTransaction();
        try {
            $userId = $student->user_id;
            
            // Hapus foto jika ada
            if ($student->user && $student->user->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($student->user->photo);
            }

            $student->delete();
            
            if ($userId) {
                User::where('id', $userId)->delete();
            }

            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('admin.students.index')->with('error', 'Gagal menghapus: data siswa masih terpakai di riwayat.');
        }
    }
}