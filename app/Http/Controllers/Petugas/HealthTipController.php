<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HealthTip;
use Illuminate\Http\Request;

class HealthTipController extends Controller
{
    // 1. Menampilkan daftar semua tips kesehatan
    public function index()
    {
        $tips = HealthTip::latest()->paginate(10);
        return view('petugas.health-tips.index', compact('tips'));
    }

    // 2. Menampilkan form untuk menambah tips baru
    public function create()
    {
        return view('petugas.health-tips.create');
    }

    // 3. Menyimpan data tips baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string',
            'content'  => 'required|string',
        ]);

        HealthTip::create($validated);
        
        return redirect()->route('petugas.health-tips.index')
                         ->with('success', 'Tips kesehatan berhasil ditambahkan.');
    }

    // 4. Menampilkan form edit untuk tips yang dipilih
    public function edit(HealthTip $healthTip)
    {
        return view('petugas.health-tips.edit', compact('healthTip'));
    }

    // 5. Memperbarui data tips ke database
    public function update(Request $request, HealthTip $healthTip)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string',
            'content'  => 'required|string',
        ]);

        $healthTip->update($validated);
        
        return redirect()->route('petugas.health-tips.index')
                         ->with('success', 'Tips kesehatan berhasil diperbarui.');
    }

    // 6. Menghapus data tips dari database
    public function destroy(HealthTip $healthTip)
    {
        $healthTip->delete();
        
        return redirect()->route('petugas.health-tips.index')
                         ->with('success', 'Tips kesehatan berhasil dihapus.');
    }
}