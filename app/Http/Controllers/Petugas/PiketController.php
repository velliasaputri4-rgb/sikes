<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\KelompokPiket;
use App\Models\AnggotaPiket;
use App\Models\JadwalPiket;
use Illuminate\Http\Request;

class PiketController extends Controller
{
    public function index()
    {
        $groups = KelompokPiket::with(['members', 'contacts'])->orderBy('order')->get();
        return view('petugas.piket.index', compact('groups'));
    }

    public function create()
    {
        return view('petugas.piket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'order' => 'required|integer|min:1',
        ]);

        KelompokPiket::create($request->only('name', 'order'));
        return redirect()->route('petugas.piket.index')->with('success', 'Grup piket berhasil ditambahkan.');
    }

    public function edit(KelompokPiket $piket)
    {
        $piket->load(['members', 'contacts']);
        return view('petugas.piket.edit', compact('piket'));
    }

    public function update(Request $request, KelompokPiket $piket)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'order' => 'required|integer|min:1',
        ]);

        $piket->update($request->only('name', 'order'));
        return redirect()->route('petugas.piket.index')->with('success', 'Grup piket berhasil diperbarui.');
    }

    public function destroy(KelompokPiket $piket)
    {
        $piket->members()->delete();
        $piket->contacts()->delete();
        $piket->delete();
        return redirect()->route('petugas.piket.index')->with('success', 'Grup piket berhasil dihapus.');
    }

    public function addMember(Request $request, KelompokPiket $piket)
    {
        $request->validate(['name' => 'required|string|max:255', 'role' => 'nullable|string|max:100']);
        $piket->members()->create($request->only('name', 'role'));
        return back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function removeMember(KelompokPiket $piket, AnggotaPiket $member)
    {
        $member->delete();
        return back()->with('success', 'Anggota berhasil dihapus.');
    }

    public function addContact(Request $request, KelompokPiket $piket)
    {
        $request->validate(['name' => 'required|string|max:255', 'phone' => 'required|string|max:20']);
        $piket->contacts()->create($request->only('name', 'phone'));
        return back()->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function removeContact(KelompokPiket $piket, JadwalPiket $contact)
    {
        $contact->delete();
        return back()->with('success', 'Kontak berhasil dihapus.');
    }
}