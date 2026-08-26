<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero Section
            [
                'key' => 'hero_title',
                'value' => "Selamat Datang di\nSistem Informasi UKS\nSMK Negeri 1 Bangsri",
                'type' => 'textarea'
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Layanan kesehatan sekolah yang modern, cepat, dan terpercaya. Kami siap melayani kebutuhan kesehatan siswa dengan profesional.',
                'type' => 'textarea'
            ],
            [
                'key' => 'hero_btn_1_text',
                'value' => 'Riwayat Kunjungan',
                'type' => 'text'
            ],
            [
                'key' => 'hero_btn_2_text',
                'value' => 'Pelajari Lebih Lanjut',
                'type' => 'text'
            ],
            
            // About Section
            [
                'key' => 'about_label',
                'value' => 'Tentang Kami',
                'type' => 'text'
            ],
            [
                'key' => 'about_title',
                'value' => 'Mengenal Lebih Dekat SIKES',
                'type' => 'text'
            ],
            [
                'key' => 'about_desc',
                'value' => 'SIKES adalah sistem informasi berbasis web yang membantu Unit Kesehatan Sekolah (UKS) mengelola data kesehatan siswa secara digital, terintegrasi, dan efisien — mulai dari pencatatan pemeriksaan, pengelolaan stok obat, hingga pembuatan laporan.',
                'type' => 'textarea'
            ],
            
            // Services Section
            [
                'key' => 'services_label',
                'value' => 'Layanan Kami',
                'type' => 'text'
            ],
            [
                'key' => 'services_title',
                'value' => 'Layanan Kesehatan Profesional',
                'type' => 'text'
            ],
            [
                'key' => 'services_subtitle',
                'value' => 'Berbagai layanan kesehatan lengkap yang kami sediakan untuk siswa',
                'type' => 'text'
            ],
            [
                'key' => 'services_data',
                'value' => json_encode([
                    ['icon' => 'fa-stethoscope', 'title' => 'Pemeriksaan Kesehatan', 'desc' => 'Pemeriksaan rutin dan saat sakit dengan tenaga profesional.'],
                    ['icon' => 'fa-pills', 'title' => 'Pelayanan Obat', 'desc' => 'Penyediaan obat lengkap dan terjamin kualitasnya.'],
                    ['icon' => 'fa-heartbeat', 'title' => 'Pertolongan Pertama', 'desc' => 'Pertolongan pertama pada kecelakaan & keadaan darurat.'],
                    ['icon' => 'fa-user-md', 'title' => 'Konsultasi Kesehatan', 'desc' => 'Konsultasi kesehatan fisik dan mental dengan petugas terlatih.'],
                    ['icon' => 'fa-clipboard-check', 'title' => 'Pemeriksaan Berkala', 'desc' => 'Pemeriksaan berkala untuk memantau kondisi siswa.'],
                    ['icon' => 'fa-graduation-cap', 'title' => 'Edukasi Kesehatan', 'desc' => 'Penyuluhan dan edukasi tentang pola hidup sehat.']
                ]),
                'type' => 'json'
            ],
            
            // Contact Section
            [
                'key' => 'contact_label',
                'value' => 'Hubungi Kami',
                'type' => 'text'
            ],
            [
                'key' => 'contact_title',
                'value' => 'Siap Melayani Anda',
                'type' => 'text'
            ],
            [
                'key' => 'contact_subtitle',
                'value' => 'Hubungi kami untuk informasi lebih lanjut tentang layanan UKS',
                'type' => 'text'
            ],
            [
                'key' => 'contact_address',
                'value' => "Komplek SMK Negeri 1 Bangsri\nJalan KH. Achmad Fauzan No.17, Bangsri, Jepara\nJawa Tengah, 59453",
                'type' => 'textarea'
            ],
            [
                'key' => 'contact_ig_handle',
                'value' => 'pmrwira_eskasaba',
                'type' => 'text'
            ],
            [
                'key' => 'contact_ig_link',
                'value' => 'https://instagram.com/pmrwira_eskasaba',
                'type' => 'text'
            ],
            [
                'key' => 'contact_yt_handle',
                'value' => 'wirasandyaadhimukti3463',
                'type' => 'text'
            ],
            [
                'key' => 'contact_yt_link',
                'value' => 'https://youtube.com/@wirasandyaadhimukti3463',
                'type' => 'text'
            ],
            
            // Footer Section
            [
                'key' => 'footer_desc',
                'value' => 'Sistem Informasi Unit Kesehatan Sekolah modern dan terpercaya untuk meningkatkan kualitas kesehatan seluruh warga sekolah.',
                'type' => 'textarea'
            ],
            [
                'key' => 'footer_copyright',
                'value' => '© ' . date('Y') . ' SIKES - Sistem Informasi UKS SMK Negeri 1 Bangsri. All rights reserved.',
                'type' => 'text'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('✅ Settings default berhasil diisi!');
    }
}