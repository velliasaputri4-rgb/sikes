<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Menyimpan perubahan pengaturan
     */
    public function update(Request $request)
    {
        try {
            // 1. KHUSUS: Handle Array Services (Ubah ke JSON agar bisa disimpan di 1 kolom)
            // Tambahan: Pastikan 'services' benar-benar array sebelum diproses
            if ($request->has('services') && is_array($request->input('services'))) {
                $servicesData = $request->input('services');
                
                Setting::updateOrCreate(
                    ['key' => 'services_data'],
                    [
                        'value' => json_encode(array_values($servicesData), JSON_UNESCAPED_UNICODE), 
                        'type' => 'json'
                    ]
                );
            }

            // 2. Abaikan token, method, gambar, dan services (karena sudah diproses di atas)
            $data = $request->except(['_token', '_method', 'navbar_logo', 'about_image', 'services']);

            // 3. Simpan semua data teks/textarea lainnya
            foreach ($data as $key => $value) {
                // PERBAIKAN PENTING: Pastikan $value adalah string. 
                // Jika null, ubah jadi string kosong agar strlen() tidak error di PHP 8+
                $stringValue = is_array($value) ? json_encode($value) : (string)($value ?? '');
                
                // Konversi Enter (\n) menjadi <br> hanya untuk field tertentu
                if (in_array($key, ['hero_title', 'contact_address'])) {
                    $stringValue = nl2br($stringValue); 
                }

                Setting::updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => $stringValue, 
                        'type' => (strlen($stringValue) > 100) ? 'textarea' : 'text'
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

        } catch (\Exception $e) {
            // 🛡️ JARING PENGAMAN: Jika ada yang gagal, kita akan TAHU alasannya, bukan gagal diam-diam
            return redirect()->back()
                ->with('error', 'Gagal menyimpan pengaturan: ' . $e->getMessage())
                ->withInput();
        }
    }
}