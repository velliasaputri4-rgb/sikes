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

        $medicines = $query->latest()->paginate(10);
        
        // Ambil kategori (fallback ke array jika tabel kategori masih kosong)
        $categories = MedicineCategory::exists() ? MedicineCategory::all() : collect([
            (object)['id' => 1, 'name' => 'Tablet'],
            (object)['id' => 2, 'name' => 'Sirup'],
            (object)['id' => 3, 'name' => 'Salep'],
            (object)['id' => 4, 'name' => 'Alat Kesehatan'],
        ]);

        return view('medicines.index', compact('medicines', 'categories'));
    }

    public function create()
    {
        $categories = MedicineCategory::exists() ? MedicineCategory::all() : collect([
            (object)['id' => 1, 'name' => 'Tablet'],
            (object)['id' => 2, 'name' => 'Sirup'],
            (object)['id' => 3, 'name' => 'Salep'],
            (object)['id' => 4, 'name' => 'Alat Kesehatan'],
        ]);
        
        return view('medicines.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'code' => 'required|unique:medicines,code|max:30',
            'name' => 'required|string|max:100',
            'unit' => 'required|string|max:30', // Contoh: Tablet, Botol, Strip
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'expired_date' => 'nullable|date',
            'storage_location' => 'nullable|string|max:100',
        ]);

        // Tentukan status otomatis berdasarkan stok dan kedaluwarsa
        $status = 'available';
        if ($validated['stock'] == 0) {
            $status = 'empty';
        } elseif ($validated['stock'] <= $validated['minimum_stock']) {
            $status = 'low_stock';
        }
        
        if ($validated['expired_date'] && Carbon::parse($validated['expired_date'])->diffInDays(now()) <= 30) {
            $status = 'near_expired';
        }
        if ($validated['expired_date'] && Carbon::parse($validated['expired_date'])->isPast()) {
            $status = 'expired';
        }

        Medicine::create(array_merge($validated, ['status' => $status]));

        return redirect()->route('medicines.index')->with('success', 'Data obat berhasil ditambahkan!');
    }

    // Method edit, update, destroy bisa ditambahkan nanti
    public function edit($id) { return view('medicines.edit'); }
    public function update(Request $request, $id) { /* Logic update */ }
    public function destroy($id) { /* Logic delete */ }
}