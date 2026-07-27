<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class PmrScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        Schedule::truncate();

        $schedules = [
            [
                'day' => 'Harian',
                'time' => '07:00 - 15:00', // Ditambahkan agar database tidak error
                'group_name' => 'Kelompok 1',
                'officer_name' => 'PMR Kelompok 1',
                'members' => json_encode([
                    'Imanuel Avrilliano (+62 831-0675-0575)',
                    'Kiki Fatmala',
                    'Cinta Aprilia Rahma',
                    'Mia Davita Kinanti (+62 896-3522-4700)',
                    'Rafika Dwi Amaliatusiva',
                    'Isnaini Irsaneta Azzahra',
                    'Nabila Raihani',
                    'Muhammad Rava Ulin Nuha',
                    'Pebriana Dwi Mubarokah',
                    'Hardiningsih Prabaningrum',
                ]),
            ],
            [
                'day' => 'Harian',
                'time' => '07:00 - 15:00',
                'group_name' => 'Kelompok 2',
                'officer_name' => 'PMR Kelompok 2',
                'members' => json_encode([
                    'Aditya Dwi Rama',
                    'Mahesti Dwi Aqilla',
                    'Faridatul Hanifah (+62 895-6031-80007)',
                    'Naysilla Zahra Mutiara',
                    'Revika Aisya Zahra',
                    'Ainun Refatul Sri Utami (+62 882-2013-9584)',
                    'Anis Zuliani',
                    'Muhammad Abdillah Faqih',
                    'Salma Putri Dwi Az Zahra',
                    'Hanaya Akni Amalina',
                ]),
            ],
            [
                'day' => 'Harian',
                'time' => '07:00 - 15:00',
                'group_name' => 'Kelompok 3',
                'officer_name' => 'PMR Kelompok 3',
                'members' => json_encode([
                    'Ivan Devano Ramadhan',
                    'Anjani Oktaviana',
                    'Purwita Khoirun Nabila',
                    'Audina Nur Kharisma',
                    'Fina Kholifatullatifah (+62 822-2684-0982)',
                    'Kurnia Putri Aulia',
                    'Sefia Ayu',
                    'Rifka Adelia Larasati',
                    'Ahmad Chrostiyanto',
                    'Tika Fanesa Putri (+62 896-8495-1515)',
                ]),
            ],
            [
                'day' => 'Harian',
                'time' => '07:00 - 15:00',
                'group_name' => 'Kelompok 4',
                'officer_name' => 'PMR Kelompok 4',
                'members' => json_encode([
                    'Muhammad Azriel Hadi Putra (+62 882-2788-1813)',
                    'Yovinda Ayuandari Oktaferata',
                    'Fariska Amelya',
                    'Kinanti Karisma Yogi Noviana',
                    'Nur Shinta Al Yahya (+62 878-8358-0771)',
                    'Rahayu Anggraini Novitasari',
                    'Donita Ayu Vega',
                    'Gandhi SatyaGraha',
                    'Meisyah Aulia Azzahra',
                    'Meli Reynata I.Y',
                ]),
            ],
            [
                'day' => 'Harian',
                'time' => '07:00 - 15:00',
                'group_name' => 'Kelompok 5',
                'officer_name' => 'PMR Kelompok 5',
                'members' => json_encode([
                    'Muhammad Dimas Prasetya (+62 851-6941-1195)',
                    'Imeliya Alifatun Zahwa',
                    'Taqiyya Indee Taher (+62 831-3731-0356)',
                    'Mbun Sekar Saifa Adiliya',
                    'Sweeta Zakiyatul Faizah',
                    'Firdausil Al Nikmah',
                    'Novi Nabila Puspitasari',
                    'Crista Bella Ratu Ayu Syara',
                    'Nakeisya Silvi Meidina',
                ]),
            ],
            [
                'day' => 'Harian',
                'time' => '07:00 - 12:00', // Sabtu jam lebih singkat
                'group_name' => 'Kelompok 6',
                'officer_name' => 'PMR Kelompok 6',
                'members' => json_encode([
                    'Qouluki Arif Wakhidin',
                    'Ticqa Maulaya S. (+62 896-0776-0270)',
                    'Yossi Shafira Indrasti',
                    'Nada Zakiya Abdillah (+62 889-8598-6109)',
                    'Shelly Zahrotul Jannah',
                    'Vanessa Putri Ariani',
                    'Danu Firmasyah',
                    'Aprillia Rahma Wati',
                    'Maidatun Nabilla Masduki',
                ]),
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }

        $this->command->info('✅ Jadwal PMR Kelompok 1-6 berhasil ditambahkan!');
    }
}