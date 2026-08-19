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
            'is_active' => true,
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

        DB::table('schedules')->where('id', $id)->update([
            'group_name' => $request->group_name,
            'description' => $request->description ?? null,
            'members' => json_encode($members),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Grup piket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('schedules')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Grup piket berhasil dihapus!');
    }
}