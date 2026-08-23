<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Abaikan token dan field gambar agar tidak diproses sebagai teks
        $data = $request->except(['_token', '_method', 'navbar_logo', 'about_image']);

        // 1. Simpan semua data teks/textarea
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => (strlen($value) > 100) ? 'textarea' : 'text']
            );
        }

        // 2. Handle Upload Gambar (Navbar Logo & About Image)
        $imageFields = ['navbar_logo', 'about_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('settings', 'public');
                
                // Hapus gambar lama jika ada
                $oldPath = Setting::where('key', $field)->value('value');
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $path, 'type' => 'image']
                );
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Semua pengaturan website berhasil diperbarui!');
    }
}