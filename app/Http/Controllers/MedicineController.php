<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MedicineController extends Controller
{
    // Helper untuk menentukan view prefix (admin atau petugas)
    private function getViewPrefix()
    {
        // Cek apakah URL mengandung '/admin/'
        if (str_contains(request()->path(), 'admin')) {
            return 'admin';
        }
        return 'petugas';
    }

    // Helper untuk menentukan route prefix
    private function getRoutePrefix()
    {
        if (str_contains(request()->path(), 'admin')) {
            return 'admin';
        }
        return 'petugas';
    }

    public function index(Request $request)
    {
        $query = Medicine::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $medicines = $query->latest()->paginate(15);
        
        // ✅ Otomatis pilih view: admin.medicines.index atau petugas.medicines.index
        return view($this->getViewPrefix() . '.medicines.index', compact('medicines'));
    }

    public function create()
    {
        // ✅ Otomatis pilih view
        return view($this->getViewPrefix() . '.medicines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:medicines,code|max:30',
            'name' => 'required|string|max:100',
            'unit' => 'required|string|max:30',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'expired_date' => 'nullable|date',
        ]);

        $status = 'available';
        if ($validated['stock'] == 0) {
            $status = 'empty';
        } elseif ($validated['stock'] <= $validated['minimum_stock']) {
            $status = 'low_stock';
        }
        
        if (!empty($validated['expired_date']) && Carbon::parse($validated['expired_date'])->diffInDays(now()) <= 30) {
            $status = 'near_expired';
        }
        if (!empty($validated['expired_date']) && Carbon::parse($validated['expired_date'])->isPast()) {
            $status = 'expired';
        }

        Medicine::create(array_merge($validated, ['status' => $status]));

        // ✅ Otomatis redirect ke route yang sesuai
        return redirect()->route($this->getRoutePrefix() . '.medicines.index')->with('success', 'Data obat berhasil ditambahkan!');
    }

    public function edit($id) 
    { 
        $medicine = Medicine::findOrFail($id);
        // ✅ Otomatis pilih view
        return view($this->getViewPrefix() . '.medicines.edit', compact('medicine')); 
    }

    public function update(Request $request, $id) 
    { 
        $medicine = Medicine::findOrFail($id);
        
        $validated = $request->validate([
            'code' => 'required|unique:medicines,code,' . $id . '|max:30',
            'name' => 'required|string|max:100',
            'unit' => 'required|string|max:30',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'expired_date' => 'nullable|date',
        ]);

        $status = 'available';
        if ($validated['stock'] == 0) {
            $status = 'empty';
        } elseif ($validated['stock'] <= $validated['minimum_stock']) {
            $status = 'low_stock';
        }
        
        if (!empty($validated['expired_date']) && Carbon::parse($validated['expired_date'])->diffInDays(now()) <= 30) {
            $status = 'near_expired';
        }
        if (!empty($validated['expired_date']) && Carbon::parse($validated['expired_date'])->isPast()) {
            $status = 'expired';
        }

        $medicine->update(array_merge($validated, ['status' => $status]));

        // ✅ Otomatis redirect ke route yang sesuai
        return redirect()->route($this->getRoutePrefix() . '.medicines.index')->with('success', 'Data obat berhasil diperbarui!');
    }

    public function destroy($id) 
    { 
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        
        // ✅ Otomatis redirect ke route yang sesuai
        return redirect()->route($this->getRoutePrefix() . '.medicines.index')->with('success', 'Data obat berhasil dihapus!');
    }
}