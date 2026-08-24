<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Mengambil semua setting dan mengubahnya menjadi array key => value
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // 1. KHUSUS: Handle Array Services (Ubah ke JSON agar bisa disimpan di 1 kolom)
        if ($request->has('services')) {
            $servicesData = $request->input('services');
            
            // array_values memastikan index array dimulai dari 0, 1, 2 dst (rapi di JSON)
            Setting::updateOrCreate(
                ['key' => 'services_data'],
                [
                    'value' => json_encode(array_values($servicesData)), 
                    'type' => 'json'
                ]
            );
        }

        // 2. Abaikan token, method, gambar, dan services (karena services sudah diproses di atas)
        $data = $request->except(['_token', '_method', 'navbar_logo', 'about_image', 'services']);

        // 3. Simpan semua data teks/textarea lainnya
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value, 
                    'type' => (strlen($value) > 100) ? 'textarea' : 'text'
                ]
            );
        }

        // 4. Handle Upload Gambar (Navbar Logo & About Image)
        $imageFields = ['navbar_logo', 'about_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                
                // Simpan file baru
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