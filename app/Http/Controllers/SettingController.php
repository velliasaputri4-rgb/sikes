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
        
        // Decode JSON agar bisa ditampilkan/di-looping di form
        $settings['services_data'] = json_decode($settings['services_data'] ?? '[]', true);
        $settings['documentations_data'] = json_decode($settings['documentations_data'] ?? '[]', true);
        
        // ✅ BARU: Decode data FAQ
        $settings['faqs_data'] = json_decode($settings['faqs_data'] ?? '[]', true);
        
        return view('petugas.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Keamanan: Hanya admin@sikes.com atau super-admin yang boleh menyimpan pengaturan
        $user = auth()->user();
        $isMainAdmin = strtolower(trim($user->email)) === 'admin@sikes.com' || $user->hasRole('super-admin');

        if (!$isMainAdmin) {
            return redirect()->route('petugas.settings.index')
                ->with('error', 'Akses ditolak: Hanya Administrator Utama yang dapat mengubah pengaturan sistem.');
        }

        try {
            // 1. Handle Array Services (TERMASUK UPLOAD GAMBAR PER ITEM)
            if ($request->has('services') && is_array($request->input('services'))) {
                $servicesData = [];

                foreach ($request->input('services') as $index => $service) {
                    if (!empty($service['title'])) {
                        $imagePath = $service['existing_image'] ?? ''; 

                        if ($request->hasFile("services.{$index}.image")) {
                            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                                Storage::disk('public')->delete($imagePath);
                            }
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

                foreach ($request->input('documentations') as $index => $doc) {
                    if (!empty($doc['title'])) {
                        $imagePath = $doc['existing_image'] ?? ''; 

                        if ($request->hasFile("documentations.{$index}.image")) {
                            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                                Storage::disk('public')->delete($imagePath);
                            }
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

            // ✅ 3. BARU: Handle Array FAQs (Tanpa gambar, hanya teks)
            if ($request->has('faqs') && is_array($request->input('faqs'))) {
                $faqsData = [];

                foreach ($request->input('faqs') as $index => $faq) {
                    // Hanya simpan jika kolom pertanyaan tidak kosong (fitur hapus implisit)
                    if (!empty(trim($faq['question']))) {
                        $faqsData[] = [
                            'question' => trim($faq['question']),
                            'answer'   => trim($faq['answer'] ?? ''),
                        ];
                    }
                }

                Setting::updateOrCreate(
                    ['key' => 'faqs_data'],
                    ['value' => json_encode($faqsData, JSON_UNESCAPED_UNICODE), 'type' => 'json']
                );
            }

            // 4. Abaikan token, method, array data, dan file inputs utama
            // ✅ PERBAIKAN: Tambahkan 'faqs' ke daftar ignore
            $ignoreKeys = ['_token', '_method', 'services', 'documentations', 'faqs', 'navbar_logo', 'about_image', 'about_page_image'];
            $data = $request->except($ignoreKeys);

            // 5. Simpan data teks/textarea lainnya
            foreach ($data as $key => $value) {
                $stringValue = is_array($value) ? json_encode($value) : (string)($value ?? '');
                
                // Ubah baris baru menjadi <br> untuk field tertentu
                if (in_array($key, ['hero_title', 'contact_address', 'about_page_mission'])) {
                    $stringValue = nl2br($stringValue); 
                }

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $stringValue, 'type' => (strlen($stringValue) > 100) ? 'textarea' : 'text']
                );
            }

            // 6. Handle Upload Gambar Utama (Navbar, About Beranda, & Halaman Tentang)
            $imageFields = ['navbar_logo', 'about_image', 'about_page_image'];
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

            return redirect()->route('petugas.settings.index')
                ->with('success', 'Semua pengaturan website berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan pengaturan: ' . $e->getMessage())
                ->withInput();
        }
    }
}