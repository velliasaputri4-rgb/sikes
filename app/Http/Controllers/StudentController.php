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
        // Catatan: Jika relasi di Model Student Anda bernama 'classroom', ubah 'class' menjadi 'classroom'
        $query = Student::with(['user', 'class']); 

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        // Fitur Filter Kelas
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $students = $query->latest()->paginate(10)->withQueryString();
        $classes = \App\Models\ClassRoom::orderBy('name')->get();

        // ✅ PERBAIKAN 1: Tambahkan prefix 'admin.' agar cocok dengan route group
        return view('admin.students.index', compact('students', 'classes'));
    }

    public function create()
    {
        $classes = \App\Models\ClassRoom::orderBy('name')->get();
        
        // ✅ PERBAIKAN 2: Tambahkan prefix 'admin.' untuk view create
        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nis' => 'required|unique:students,nis|max:20',
            'full_name' => 'required|string|max:100',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date|before:today',
            'class_id' => 'required|exists:classes,id', // Sesuaikan 'classes' dengan nama tabel kelas Anda (misal: class_rooms)
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // 2. Upload Foto (Jika ada)
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('students', 'public');
            }

            // 3. Buat Akun User untuk Siswa
            $defaultPassword = $validated['nis'] . str_replace('-', '', $validated['birth_date']);
            
            $user = User::create([
                'name' => $validated['full_name'],
                'email' => strtolower(str_replace(' ', '', $validated['full_name'])) . '@sikes.sch.id',
                'password' => Hash::make($defaultPassword),
                'phone' => $validated['parent_phone'],
                'photo' => $photoPath,
                'status' => 'active',
            ]);
            
            $user->assignRole('siswa');

            // 4. Buat Data Siswa
            Student::create([
                'user_id' => $user->id,
                'class_id' => $validated['class_id'],
                'nis' => $validated['nis'],
                'full_name' => $validated['full_name'],
                'gender' => $validated['gender'],
                'birth_date' => $validated['birth_date'],
                'address' => $validated['address'],
                'parent_phone' => $validated['parent_phone'],
            ]);

            DB::commit();
            
            // ✅ PERBAIKAN 3: Redirect ke route 'admin.students.index'
            return redirect()->route('admin.students.index')->with('success', 'Data siswa dan akun berhasil dibuat! Password default: ' . $defaultPassword);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }
    }
}