<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'group_name' => 'KELOMPOK 1',
                'description' => 'Jadwal Piket Upacara dan Kebersihan UKS PMR WSA',
                'is_active' => true,
                'members' => [
                    ['name' => 'Imanuel Avrilliano', 'phone' => '+62 831-0675-0575'],
                    ['name' => 'Kiki Fatmala'],
                    ['name' => 'Cinta Aprilia Rahma'],
                    ['name' => 'Mia Davita Kinanti', 'phone' => '+62 896-3522-4700'],
                    ['name' => 'Rafika Dwi Amaliatusiva'],
                    ['name' => 'Isnaini Irsaneta Azzahra'],
                    ['name' => 'Nabila Raihani'],
                    ['name' => 'Muhammad Rava Ulin Nuha'],
                    ['name' => 'Pebriana Dwi Mubarokah'],
                    ['name' => 'Hardiningsih Prabaningrum'],
                ]
            ],
            [
                'group_name' => 'KELOMPOK 2',
                'description' => 'Jadwal Piket Upacara dan Kebersihan UKS PMR WSA',
                'is_active' => true,
                'members' => [
                    ['name' => 'Aditya Dwi Rama'],
                    ['name' => 'Mahesti Dwi Aqilla'],
                    ['name' => 'Faridatul Hanifah', 'phone' => '+62 895-6031-80007'],
                    ['name' => 'Naysilla Zahra Mutiara'],
                    ['name' => 'Revika Aisya Zahra'],
                    ['name' => 'Ainun Refatul Sri Utami', 'phone' => '+62 882-2013-9584'],
                    ['name' => 'Anis Zuliani'],
                    ['name' => 'Muhammad Abdillah Faqih'],
                    ['name' => 'Salma Putri Dwi Az Zahra'],
                    ['name' => 'Hanaya Akni Amalina'],
                ]
            ],
            [
                'group_name' => 'KELOMPOK 3',
                'description' => 'Jadwal Piket Upacara dan Kebersihan UKS PMR WSA',
                'is_active' => true,
                'members' => [
                    ['name' => 'Ivan Devano Ramadhan'],
                    ['name' => 'Anjani Oktaviana'],
                    ['name' => 'Purwita Khoirun Nabila'],
                    ['name' => 'Audina Nur Kharisma'],
                    ['name' => 'Fina Kholifatullatifah', 'phone' => '+62 822-2684-0982'],
                    ['name' => 'Kurnia Putri Aulia'],
                    ['name' => 'Sefia Ayu'],
                    ['name' => 'Rifka Adelia Larasati'],
                    ['name' => 'Ahmad Chrostiyanto'],
                    ['name' => 'Tika Fanesa Putri', 'phone' => '+62 896-8495-1515'],
                ]
            ],
            [
                'group_name' => 'KELOMPOK 4',
                'description' => 'Jadwal Piket Upacara dan Kebersihan UKS PMR WSA',
                'is_active' => true,
                'members' => [
                    ['name' => 'Muhammad Azriel Hadi Putra', 'phone' => '+62 882-2788-1813'],
                    ['name' => 'Yovinda Ayuandari Oktaferata'],
                    ['name' => 'Fariska Amelya'],
                    ['name' => 'Kinanti Karisma Yogi Noviana'],
                    ['name' => 'Nur Shinta Al Yahya', 'phone' => '+62 878-8358-0771'],
                    ['name' => 'Rahayu Anggraini Novitasari'],
                    ['name' => 'Donita Ayu Vega'],
                    ['name' => 'Gandhi SatyaGraha'],
                    ['name' => 'Meisyah Aulia Azzahra'],
                    ['name' => 'Meli Reynata I.Y'],
                ]
            ],
            [
                'group_name' => 'KELOMPOK 5',
                'description' => 'Jadwal Piket Upacara dan Kebersihan UKS PMR WSA',
                'is_active' => true,
                'members' => [
                    ['name' => 'Muhammad Dimas Prasetya', 'phone' => '+62 851-6941-1195'],
                    ['name' => 'Imeliya Alifatun Zahwa'],
                    ['name' => 'Taqiyya Indee Taher', 'phone' => '+62 831-3731-0356'],
                    ['name' => 'Mbun Sekar Saifa Adiliya'],
                    ['name' => 'Sweeta Zakiyatul Faizah'],
                    ['name' => 'Firdausil Al Nikmah'],
                    ['name' => 'Novi Nabila Puspitasari'],
                    ['name' => 'Crista Bella Ratu Ayu Syara'],
                    ['name' => 'Nakeisya Silvi Meidina'],
                ]
            ],
            [
                'group_name' => 'KELOMPOK 6',
                'description' => 'Jadwal Piket Upacara dan Kebersihan UKS PMR WSA',
                'is_active' => true,
                'members' => [
                    ['name' => 'Qouluki Arif Wakhidin'],
                    ['name' => 'Ticqa Maulaya S.', 'phone' => '+62 896-0776-0270'],
                    ['name' => 'Yossi Shafira Indrasti'],
                    ['name' => 'Nada Zakiya Abdillah', 'phone' => '+62 889-8598-6109'],
                    ['name' => 'Shelly Zahrotul Jannah'],
                    ['name' => 'Vanessa Putri Ariani'],
                    ['name' => 'Danu Firmasyah'],
                    ['name' => 'Aprillia Rahma Wati'],
                    ['name' => 'Maidatun Nabilla Masduki'],
                ]
            ],
        ];

        foreach ($data as $schedule) {
            Schedule::create($schedule);
        }
    }
}