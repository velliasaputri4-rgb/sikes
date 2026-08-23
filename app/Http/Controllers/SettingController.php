<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil semua setting dan ubah menjadi array [key => value] agar mudah dipakai di form
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'school_logo']);

        // 1. Simpan data teks/textarea
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'text']
            );
        }

        // 2. Handle Upload Logo (Jika ada file baru)
        if ($request->hasFile('school_logo')) {
            $file = $request->file('school_logo');
            $path = $file->store('settings', 'public');
            
            // Hapus logo lama jika ada
            $oldLogo = Setting::where('key', 'school_logo')->value('value');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            Setting::updateOrCreate(
                ['key' => 'school_logo'],
                ['value' => $path, 'type' => 'image']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Semua pengaturan website berhasil diperbarui!');
    }
}