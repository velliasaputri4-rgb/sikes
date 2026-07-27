<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Item;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['item', 'student.user'])
            ->latest()
            ->paginate(15);
        return view('petugas.borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $items = Item::where('available', '>', 0)->orderBy('name')->get();
        $students = Student::with('user')->orderBy('full_name')->get();
        return view('petugas.borrowings.create', compact('items', 'students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'student_id' => 'required|exists:students,id',
            'borrow_date' => 'required|date',
            'expected_return_date' => 'nullable|date|after_or_equal:borrow_date',
            'notes' => 'nullable|string',
        ]);

        $item = Item::findOrFail($validated['item_id']);
        
        if ($item->available < 1) {
            return back()->with('error', 'Stok barang tidak mencukupi!');
        }

        // Buat peminjaman
        Borrowing::create([
            'item_id' => $validated['item_id'],
            'student_id' => $validated['student_id'],
            'borrowed_by' => auth()->id(),
            'borrow_date' => $validated['borrow_date'],
            'expected_return_date' => $validated['expected_return_date'],
            'status' => 'borrowed',
            'notes' => $validated['notes'],
        ]);

        // Kurangi stok available
        $item->decrement('available');

        return redirect()->route('petugas.borrowings.index')
            ->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function returnItem($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        $borrowing->update([
            'return_date' => Carbon::now(),
            'status' => 'returned',
        ]);

        // Kembalikan stok
        $borrowing->item->increment('available');

        return redirect()->route('petugas.borrowings.index')
            ->with('success', 'Pengembalian berhasil dicatat!');
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        // Jika masih dipinjam, kembalikan stok
        if ($borrowing->status === 'borrowed') {
            $borrowing->item->increment('available');
        }
        
        $borrowing->delete();

        return redirect()->route('petugas.borrowings.index')
            ->with('success', 'Data peminjaman dihapus!');
    }
}