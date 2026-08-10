<?php

namespace Database\Seeders;

use App\Models\AnggotaPiket;
use App\Models\JadwalPiket;
use App\Models\KelompokPiket;
use Illuminate\Database\Seeder;

class PiketSeeder extends Seeder
{
    public function run(): void
    {
        $dataKelompok = [
            'Kelompok 1' => [
                ['nama' => 'Imanuel Avrilliano', 'telepon' => '+6283106750575'],
                ['nama' => 'Kiki Fatmala', 'telepon' => null],
                ['nama' => 'Cinta Aprilia Rahma', 'telepon' => null],
                ['nama' => 'Mia Davita Kinanti', 'telepon' => '+6289635224700'],
                ['nama' => 'Rafika Dwi Amaliatusiva', 'telepon' => null],
                ['nama' => 'Isnaini Irsaneta Azzahra', 'telepon' => null],
                ['nama' => 'Nabila Raihani', 'telepon' => null],
                ['nama' => 'Muhammad Rava Ulin Nuha', 'telepon' => null],
                ['nama' => 'Pebriana Dwi Mubarokah', 'telepon' => null],
                ['nama' => 'Hardiningsih Prabaningrum', 'telepon' => null],
            ],

            'Kelompok 2' => [
                ['nama' => 'Aditya Dwi Rama', 'telepon' => null],
                ['nama' => 'Mahesti Dwi Aqilla', 'telepon' => null],
                ['nama' => 'Faridatul Hanifah', 'telepon' => '+62895603180007'],
                ['nama' => 'Naysilla Zahra Mutiara', 'telepon' => null],
                ['nama' => 'Revika Aisya Zahra', 'telepon' => null],
                ['nama' => 'Ainun Refatul Sri Utami', 'telepon' => '+6288220139584'],
                ['nama' => 'Anis Zuliani', 'telepon' => null],
                ['nama' => 'Muhammad Abdillah Faqih', 'telepon' => null],
                ['nama' => 'Salma Putri Dwi Az Zahra', 'telepon' => null],
                ['nama' => 'Hanaya Akni Amalina', 'telepon' => null],
            ],

            'Kelompok 3' => [
                ['nama' => 'Ivan Devano Ramadhan', 'telepon' => null],
                ['nama' => 'Anjani Oktaviana', 'telepon' => null],
                ['nama' => 'Purwita Khoirun Nabila', 'telepon' => null],
                ['nama' => 'Audina Nur Kharisma', 'telepon' => null],
                ['nama' => 'Fina Kholifatullatifah', 'telepon' => '+6282226840982'],
                ['nama' => 'Kurnia Putri Aulia', 'telepon' => null],
                ['nama' => 'Sefia Ayu', 'telepon' => null],
                ['nama' => 'Rifka Adelia Larasati', 'telepon' => null],
                ['nama' => 'Ahmad Chrostiyanto', 'telepon' => null],
                ['nama' => 'Tika Fanesa Putri', 'telepon' => '+6289684951515'],
            ],

            'Kelompok 4' => [
                ['nama' => 'Muhammad Azriel Hadi Putra', 'telepon' => '+6288227881813'],
                ['nama' => 'Yovinda Ayuandari Oktaferata', 'telepon' => null],
                ['nama' => 'Fariska Amelya', 'telepon' => null],
                ['nama' => 'Kinanti Karisma Yogi Noviana', 'telepon' => null],
                ['nama' => 'Nur Shinta Al Yahya', 'telepon' => '+6287883580771'],
                ['nama' => 'Rahayu Anggraini Novitasari', 'telepon' => null],
                ['nama' => 'Donita Ayu Vega', 'telepon' => null],
                ['nama' => 'Gandhi SatyaGraha', 'telepon' => null],
                ['nama' => 'Meisyah Aulia Azzahra', 'telepon' => null],
                ['nama' => 'Meli Reynata I.Y', 'telepon' => null],
            ],

            'Kelompok 5' => [
                ['nama' => 'Muhammad Dimas Prasetya', 'telepon' => '+6285169411195'],
                ['nama' => 'Imeliya Alifatun Zahwa', 'telepon' => null],
                ['nama' => 'Taqiyya Indee Taher', 'telepon' => '+6283137310356'],
                ['nama' => 'Mbun Sekar Saifa Adiliya', 'telepon' => null],
                ['nama' => 'Sweeta Zakiyatul Faizah', 'telepon' => null],
                ['nama' => 'Firdausil Al Nikmah', 'telepon' => null],
                ['nama' => 'Novi Nabila Puspitasari', 'telepon' => null],
                ['nama' => 'Crista Bella Ratu Ayu Syara', 'telepon' => null],
                ['nama' => 'Nakeisya Silvi Meidina', 'telepon' => null],
            ],

            'Kelompok 6' => [
                ['nama' => 'Qouluki Arif Wakhidin', 'telepon' => null],
                ['nama' => 'Ticqa Maulaya S.', 'telepon' => '+6289607760270'],
                ['nama' => 'Yossi Shafira Indrasti', 'telepon' => null],
                ['nama' => 'Nada Zakiya Abdillah', 'telepon' => '+6288985986109'],
                ['nama' => 'Shelly Zahrotul Jannah', 'telepon' => null],
                ['nama' => 'Vanessa Putri Ariani', 'telepon' => null],
                ['nama' => 'Danu Firmasyah', 'telepon' => null],
                ['nama' => 'Aprillia Rahma Wati', 'telepon' => null],
                ['nama' => 'Maidatun Nabilla Masduki', 'telepon' => null],
            ],
        ];

        // Simpan kelompok dan anggota
        foreach ($dataKelompok as $namaKelompok => $anggotas) {
            $kelompok = KelompokPiket::updateOrCreate(
                ['nama' => $namaKelompok]
            );

            foreach ($anggotas as $anggota) {
                AnggotaPiket::updateOrCreate(
                    [
                        'kelompok_piket_id' => $kelompok->id,
                        'nama' => $anggota['nama'],
                    ],
                    [
                        'telepon' => $anggota['telepon'] ?? null,
                        'is_kontak' => filled($anggota['telepon'] ?? null),
                    ]
                );
            }
        }

        // Contoh jadwal default minggu ini
        // Karena file belum berisi mapping hari/kelompok, saya buatkan rotasi contoh.
        $kelompokIds = KelompokPiket::orderBy('id')->pluck('id');
        $mulaiMingguIni = now()->startOfWeek();

        // Jadwal kebersihan UKS Senin - Sabtu
        for ($i = 0; $i < 6; $i++) {
            $tanggal = $mulaiMingguIni->copy()->addDays($i);

            JadwalPiket::updateOrCreate(
                [
                    'tanggal' => $tanggal->toDateString(),
                    'jenis' => 'kebersihan_uks',
                ],
                [
                    'kelompok_piket_id' => $kelompokIds[$i % $kelompokIds->count()],
                    'keterangan' => 'Piket kebersihan UKS',
                ]
            );
        }

        // Jadwal upacara hari Senin
        JadwalPiket::updateOrCreate(
            [
                'tanggal' => $mulaiMingguIni->toDateString(),
                'jenis' => 'upacara',
            ],
            [
                'kelompok_piket_id' => $kelompokIds[0],
                'keterangan' => 'Petugas upacara hari Senin',
            ]
        );
    }
}