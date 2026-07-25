<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, Student, ClassRoom, Major};
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Jurusan & Kelas dulu
        $major = Major::firstOrCreate(['name' => 'Rekayasa Perangkat Lunak', 'code' => 'RPL']);
        
        $class1 = ClassRoom::firstOrCreate([
            'major_id' => $major->id,
            'name' => 'XI RPL 1',
            'code' => 'XI-RPL-1',
            'grade' => 11
        ]);

        $class2 = ClassRoom::firstOrCreate([
            'major_id' => $major->id,
            'name' => 'XI RPL 2',
            'code' => 'XI-RPL-2',
            'grade' => 11
        ]);

        // 2. Buat 5 Siswa Dummy
        $students = [
            [
                'nis' => '12345678',
                'full_name' => 'Natasya Meylani Sahputri',
                'gender' => 'P',
                'birth_date' => '2008-01-15',
                'class_id' => $class1->id,
                'parent_phone' => '081234567890',
            ],
            [
                'nis' => '12345679',
                'full_name' => 'Dinda Putri',
                'gender' => 'P',
                'birth_date' => '2008-03-22',
                'class_id' => $class1->id,
                'parent_phone' => '081234567891',
            ],
            [
                'nis' => '12345680',
                'full_name' => 'Raka Aditya',
                'gender' => 'L',
                'birth_date' => '2007-11-10',
                'class_id' => $class2->id,
                'parent_phone' => '081234567892',
            ],
            [
                'nis' => '12345681',
                'full_name' => 'Andi Saputra',
                'gender' => 'L',
                'birth_date' => '2008-05-18',
                'class_id' => $class2->id,
                'parent_phone' => '081234567893',
            ],
            [
                'nis' => '12345682',
                'full_name' => 'Siti Aisyah',
                'gender' => 'P',
                'birth_date' => '2008-07-25',
                'class_id' => $class1->id,
                'parent_phone' => '081234567894',
            ],
        ];

        foreach ($students as $data) {
            // Buat User
            $user = User::create([
                'name' => $data['full_name'],
                'email' => strtolower(str_replace(' ', '', $data['full_name'])) . '@sikes.sch.id',
                'password' => Hash::make($data['nis'] . str_replace('-', '', $data['birth_date'])),
                'status' => 'active',
            ]);
            $user->assignRole('siswa');

            // Buat Student
            Student::create([
                'user_id' => $user->id,
                'class_id' => $data['class_id'],
                'nis' => $data['nis'],
                'full_name' => $data['full_name'],
                'gender' => $data['gender'],
                'birth_date' => $data['birth_date'],
                'parent_phone' => $data['parent_phone'],
            ]);
        }

        $this->command->info('✅ 5 siswa dummy berhasil dibuat!');
    }
}