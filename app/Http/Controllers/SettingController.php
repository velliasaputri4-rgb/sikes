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
        
        // Decode JSON services dan documentations agar bisa ditampilkan di form
        $settings['services_data'] = json_decode($settings['services_data'] ?? '[]', true);
        $settings['documentations_data'] = json_decode($settings['documentations_data'] ?? '[]', true);
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        try {
            // 1. Handle Array Services (TERMASUK UPLOAD GAMBAR PER ITEM)
            if ($request->has('services') && is_array($request->input('services'))) {
                $servicesData = [];
                $oldServices = json_decode(Setting::where('key', 'services_data')->value('value') ?? '[]', true);

                foreach ($request->input('services') as $index => $service) {
                    if (!empty($service['title'])) {
                        $imagePath = $service['existing_image'] ?? ''; // Pertahankan gambar lama

                        // Jika ada file gambar baru diupload untuk layanan ini
                        if ($request->hasFile("services.{$index}.image")) {
                            // Hapus gambar lama jika ada
                            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                                Storage::disk('public')->delete($imagePath);
                            }
                            // Simpan gambar baru
                            $imagePath = $request->file("services.{$index}.image")->store('services', 'public');
                        }

                        $servicesData[] = [
                            'icon'  => $service['icon'] ?? 'fa-star',
                            'title' => $service['title'],
                            'desc'  => $service['desc'] ?? '',
                            'image' => $imagePath,
                        ];
                    }
                }

                Setting::updateOrCreate(
                    ['key' => 'services_data'],
                    ['value' => json_encode($servicesData, JSON_UNESCAPED_UNICODE), 'type' => 'json']
                );
            }

            // 2. Handle Array Documentations (TERMASUK UPLOAD GAMBAR PER ITEM)
            if ($request->has('documentations') && is_array($request->input('documentations'))) {
                $docsData = [];
                $oldDocs = json_decode(Setting::where('key', 'documentations_data')->value('value') ?? '[]', true);

                foreach ($request->input('documentations') as $index => $doc) {
                    if (!empty($doc['title'])) {
                        $imagePath = $doc['existing_image'] ?? ''; // Pertahankan gambar lama

                        // Jika ada file gambar baru diupload untuk baris ini
                        if ($request->hasFile("documentations.{$index}.image")) {
                            // Hapus gambar lama jika ada
                            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                                Storage::disk('public')->delete($imagePath);
                            }
                            // Simpan gambar baru
                            $imagePath = $request->file("documentations.{$index}.image")->store('documentations', 'public');
                        }

                        $docsData[] = [
                            'title'        => $doc['title'],
                            'excerpt'      => $doc['excerpt'] ?? '',
                            'video_link'   => $doc['video_link'] ?? '',
                            'published_at' => $doc['published_at'] ?? now()->toDateString(),
                            'image'        => $imagePath,
                        ];
                    }
                }

                Setting::updateOrCreate(
                    ['key' => 'documentations_data'],
                    ['value' => json_encode($docsData, JSON_UNESCAPED_UNICODE), 'type' => 'json']
                );
            }

            // 3. Abaikan token, method, services, documentations, dan file inputs utama
            $ignoreKeys = ['_token', '_method', 'services', 'documentations', 'navbar_logo', 'about_image'];
            $data = $request->except($ignoreKeys);

            // 4. Simpan data teks/textarea lainnya
            foreach ($data as $key => $value) {
                $stringValue = is_array($value) ? json_encode($value) : (string)($value ?? '');
                
                if (in_array($key, ['hero_title', 'contact_address'])) {
                    $stringValue = nl2br($stringValue); 
                }

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $stringValue, 'type' => (strlen($stringValue) > 100) ? 'textarea' : 'text']
                );
            }

            // 5. Handle Upload Gambar Utama (Navbar & About)
            $imageFields = ['navbar_logo', 'about_image'];
            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $path = $file->store('settings', 'public');
                    
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
            return redirect()->back()
                ->with('error', 'Gagal menyimpan pengaturan: ' . $e->getMessage())
                ->withInput();
        }
    }
}