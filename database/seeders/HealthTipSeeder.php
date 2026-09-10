<?php

namespace Database\Seeders;

use App\Models\HealthTip;
use Illuminate\Database\Seeder;

class HealthTipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tips = [
            [
                'title' => 'Pola Makan Sehat untuk Remaja',
                'category' => 'gizi',
                'content' => "Masa remaja adalah periode penting pertumbuhan dan perkembangan. Pola makan yang sehat sangat penting untuk mendukung proses ini.\n\nPrinsip Gizi Seimbang:\n- Konsumsi makanan pokok sebagai sumber karbohidrat\n- Perbanyak sayur dan buah (minimal 5 porsi sehari)\n- Konsumsi lauk pauk sumber protein\n- Batasi gula, garam, dan lemak\n- Minum air putih minimal 8 gelas sehari",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cara Mencegah Demam Berdarah',
                'category' => 'penyakit',
                'content' => "Demam Berdarah Dengue (DBD) ditularkan melalui gigitan nyamuk Aedes aegypti.\n\nLangkah Pencegahan 3M Plus:\n1. Menguras tempat penampungan air secara rutin\n2. Menutup rapat tempat penampungan air\n3. Mengubur barang bekas yang bisa menampung air\n4. Plus: Gunakan lotion anti nyamuk dan jaga kebersihan lingkungan",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mengatasi Stres Saat Ujian',
                'category' => 'kesehatan_mental',
                'content' => "Stres adalah respons alami tubuh terhadap tekanan. Wajar merasa cemas sebelum ujian, tapi stres berlebihan bisa mengganggu kesehatan.\n\nTeknik Relaksasi:\n1. Pernapasan Dalam: Tarik napas 4 detik, tahan 4 detik, buang 4 detik\n2. Tidur Cukup: Minimal 7-8 jam per hari\n3. Olahraga: Aktivitas fisik membantu mengurangi hormon stres",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mengenali dan Mencegah Anemia',
                'category' => 'penyakit',
                'content' => "Anemia adalah kondisi ketika tubuh kekurangan sel darah merah sehat. Gejala umum meliputi pusing, lemas, pucat, dan sulit berkonsentrasi.\n\nCara Pencegahan:\n- Konsumsi makanan kaya zat besi (daging merah, bayam, kacang-kacangan)\n- Kombinasikan dengan vitamin C (jeruk, tomat) untuk penyerapan maksimal\n- Hindari minum teh atau kopi bersamaan dengan makan",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pentingnya Menjaga Kesehatan Gigi',
                'category' => 'kebersihan',
                'content' => "Kesehatan gigi dan mulut sangat berpengaruh pada kesehatan tubuh secara keseluruhan dan kepercayaan diri.\n\nTips Menjaga Kesehatan Gigi:\n- Sikat gigi minimal 2 kali sehari (pagi setelah sarapan dan malam sebelum tidur)\n- Gunakan pasta gigi mengandung fluoride\n- Kurangi konsumsi makanan dan minuman manis atau asam\n- Ganti sikat gigi setiap 3 bulan sekali",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mencegah Penyebaran Flu dan ISPA',
                'category' => 'penyakit',
                'content' => "Influenza dan Infeksi Saluran Pernapasan Akut (ISPA) sangat mudah menular di lingkungan sekolah yang padat.\n\nLangkah Pencegahan:\n- Cuci tangan dengan sabun dan air mengalir secara rutin\n- Gunakan masker jika sedang batuk atau pilek\n- Tutup mulut dan hidung dengan siku bagian dalam saat bersin\n- Istirahat di rumah jika gejala demam tinggi",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Menjaga Kesehatan Mata di Era Digital',
                'category' => 'umum',
                'content' => "Penggunaan gadget yang berlebihan dapat menyebabkan Computer Vision Syndrome (mata lelah, kering, dan blur).\n\nAturan 20-20-20:\n- Setiap 20 menit menatap layar, alihkan pandangan\n- Lihat objek yang berjarak 20 kaki (sekitar 6 meter)\n- Lakukan selama 20 detik\n- Pastikan pencahayaan ruangan cukup saat belajar",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bahaya Rokok dan Vape bagi Pelajar',
                'category' => 'penyakit',
                'content' => "Rokok dan vape mengandung nikotin dan zat kimia berbahaya yang dapat mengganggu perkembangan otak remaja.\n\nDampak Negatif:\n- Gangguan konsentrasi dan daya ingat\n- Kerusakan paru-paru dan peningkatan risiko penyakit jantung\n- Kecanduan yang sulit dihentikan\n\nCara Menolak: Katakan 'Tidak, terima kasih' dengan tegas dan hindari pergaulan yang mendorong perilaku merokok.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dasar-Dasar Pertolongan Pertama (P3K)',
                'category' => 'p3k',
                'content' => "Pertolongan Pertama pada Kecelakaan (P3K) adalah tindakan awal yang penting sebelum mendapatkan penanganan medis lanjutan.\n\nLangkah Dasar:\n1. Luka Ringan: Bersihkan dengan air mengalir, beri antiseptik, dan tutup dengan plester.\n2. Memar: Kompres dingin selama 15-20 menit untuk mengurangi bengkak.\n3. Pingsan: Baringkan, tinggikan kaki, longgarkan pakaian, dan pastikan jalan napas terbuka.\n4. Segera laporkan ke petugas UKS atau guru.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($tips as $tip) {
            HealthTip::create($tip);
        }

        $this->command->info('✅ 9 Data Tips Kesehatan berhasil ditambahkan!');
    }
}