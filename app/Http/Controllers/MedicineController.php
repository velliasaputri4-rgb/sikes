<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicine::with('category');

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $medicines = $query->latest()->paginate(15);
        
        // Ambil kategori (fallback ke array jika tabel kategori masih kosong)
        $categories = MedicineCategory::exists() ? MedicineCategory::all() : collect([
            (object)['id' => 1, 'name' => 'Tablet'],
            (object)['id' => 2, 'name' => 'Sirup'],
            (object)['id' => 3, 'name' => 'Salep'],
            (object)['id' => 4, 'name' => 'Alat Kesehatan'],
        ]);

        // ✅ PERBAIKAN: Gunakan prefix petugas. untuk view
        return view('petugas.medicines.index', compact('medicines', 'categories'));
    }

    public function create()
    {
        $categories = MedicineCategory::exists() ? MedicineCategory::all() : collect([
            (object)['id' => 1, 'name' => 'Tablet'],
            (object)['id' => 2, 'name' => 'Sirup'],
            (object)['id' => 3, 'name' => 'Salep'],
            (object)['id' => 4, 'name' => 'Alat Kesehatan'],
        ]);
        
        // ✅ PERBAIKAN: Gunakan prefix petugas. untuk view
        return view('petugas.medicines.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:medicine_categories,id',
            'code' => 'required|unique:medicines,code|max:30',
            'name' => 'required|string|max:100',
            'unit' => 'required|string|max:30',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'expired_date' => 'nullable|date',
        ]);

        // Tentukan status otomatis berdasarkan stok dan kedaluwarsa
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

        // ✅ PERBAIKAN: Gunakan prefix petugas. untuk redirect
        return redirect()->route('petugas.medicines.index')->with('success', 'Data obat berhasil ditambahkan!');
    }

    public function edit($id) 
    { 
        $medicine = Medicine::findOrFail($id);
        $categories = MedicineCategory::exists() ? MedicineCategory::all() : collect([]);
        return view('petugas.medicines.edit', compact('medicine', 'categories')); 
    }

    public function update(Request $request, $id) 
    { 
        $medicine = Medicine::findOrFail($id);
        
        $validated = $request->validate([
            'category_id' => 'nullable|exists:medicine_categories,id',
            'code' => 'required|unique:medicines,code,' . $id . '|max:30',
            'name' => 'required|string|max:100',
            'unit' => 'required|string|max:30',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'expired_date' => 'nullable|date',
        ]);

        // Tentukan status otomatis
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

        return redirect()->route('petugas.medicines.index')->with('success', 'Data obat berhasil diperbarui!');
    }

    public function destroy($id) 
    { 
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        
        return redirect()->route('petugas.medicines.index')->with('success', 'Data obat berhasil dihapus!');
    }
}