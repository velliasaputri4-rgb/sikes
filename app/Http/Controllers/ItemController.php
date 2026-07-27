<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->paginate(15);
        return view('petugas.items.index', compact('items'));
    }

    public function create()
    {
        return view('petugas.items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:items,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|in:good,damaged,lost',
            'category' => 'nullable|string|max:100',
        ]);

        $validated['available'] = $validated['quantity'];

        Item::create($validated);

        return redirect()->route('petugas.items.index')
            ->with('success', 'Barang inventaris berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('petugas.items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        
        $validated = $request->validate([
            'code' => 'required|unique:items,code,' . $id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|in:good,damaged,lost',
            'category' => 'nullable|string|max:100',
        ]);

        $item->update($validated);

        return redirect()->route('petugas.items.index')
            ->with('success', 'Barang inventaris berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('petugas.items.index')
            ->with('success', 'Barang inventaris berhasil dihapus!');
    }
}