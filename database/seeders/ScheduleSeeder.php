<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            [
                'day' => 'Senin - Jumat',
                'officer_name' => 'Petugas UKS',
                'time' => '07:00 - 15:00'
            ],
            [
                'day' => 'Sabtu',
                'officer_name' => 'Petugas Piket',
                'time' => '07:00 - 12:00'
            ]
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }

        $this->command->info('✅ Jadwal petugas berhasil ditambahkan!');
    }
}