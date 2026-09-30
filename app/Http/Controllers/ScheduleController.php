<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan ID, ambil data paginasi
        $schedules = DB::table('schedules')
            ->orderBy('id', 'asc')
            ->paginate(10);
            
        return view('petugas.schedules.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'members' => 'nullable|array',
        ]);

        $members = [];
        if ($request->has('members')) {
            foreach ($request->members as $member) {
                if (!empty($member['name'])) {
                    $members[] = [
                        'name' => $member['name'],
                        'phone' => $member['phone'] ?? ''
                    ];
                }
            }
        }

        DB::table('schedules')->insert([
            'group_name' => $request->group_name,
            'description' => $request->description ?? null,
            'members' => json_encode($members),
            'is_active' => true, // Default aktif saat dibuat
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Grup piket berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'members' => 'nullable|array',
        ]);

        $members = [];
        if ($request->has('members')) {
            foreach ($request->members as $member) {
                if (!empty($member['name'])) {
                    $members[] = [
                        'name' => $member['name'],
                        'phone' => $member['phone'] ?? ''
                    ];
                }
            }
        }

        // Ambil data lama untuk mempertahankan status is_active jika tidak dikirim dari form edit
        $currentSchedule = DB::table('schedules')->where('id', $id)->first();

        DB::table('schedules')->where('id', $id)->update([
            'group_name' => $request->group_name,
            'description' => $request->description ?? null,
            'members' => json_encode($members),
            'is_active' => $currentSchedule ? $currentSchedule->is_active : true, // Pertahankan status
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Grup piket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('schedules')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Grup piket berhasil dihapus!');
    }

    /**
     * ✅ BARU: Method untuk menangani toggle status Aktif/Nonaktif via AJAX
     */
    public function toggleStatus(Request $request, $id)
    {
        try {
            // Validasi input dari frontend
            $request->validate([
                'is_active' => 'required|boolean'
            ]);

            // Cek apakah data ada
            $schedule = DB::table('schedules')->where('id', $id)->first();
            
            if (!$schedule) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data jadwal tidak ditemukan.'
                ], 404);
            }

            // Update status is_active
            DB::table('schedules')->where('id', $id)->update([
                'is_active' => $request->is_active,
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diubah menjadi ' . ($request->is_active ? 'Aktif' : 'Nonaktif')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ], 500);
        }
    }
}