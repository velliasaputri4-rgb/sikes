<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Jurusan PPLG
        $major = Major::firstOrCreate(
            ['name' => 'PPLG'],
            ['name' => 'PPLG', 'code' => 'PPLG']
        );

        // nis = NIS LOKAL (untuk form cek riwayat), nisn = NISN lama (untuk mencocokkan data lama)
        $classes = [
            'XII PPLG 1' => [
                ['nis' => '4653', 'nisn' => '0087015999', 'full_name' => 'ADRISTY AKIKO YUKINATA', 'birth_date' => '2008-12-16'],
                ['nis' => '4654', 'nisn' => '0095901445', 'full_name' => 'AFRIAN PRYO SULISTYANNO', 'birth_date' => '2009-04-20'],
                ['nis' => '4655', 'nisn' => '0094370434', 'full_name' => 'ALLEA ANANTA LARASATI', 'birth_date' => '2009-05-12'],
                ['nis' => '4656', 'nisn' => '0086014645', 'full_name' => 'ANGEN SURYA SYAFIURROHMAH', 'birth_date' => '2008-08-24'],
                ['nis' => '4657', 'nisn' => '0099720482', 'full_name' => 'ARVIN ERIK SETIAWAN', 'birth_date' => '2009-06-10'],
                ['nis' => '4658', 'nisn' => '0088427317', 'full_name' => 'ASKIA KHOIRUN NISA', 'birth_date' => '2008-07-29'],
                ['nis' => '4659', 'nisn' => '3083701334', 'full_name' => 'AZALENTA SIFATUL SITA', 'birth_date' => '2008-10-12'],
                ['nis' => '4660', 'nisn' => '0099753516', 'full_name' => 'BILLEAN UJI PRAKASA', 'birth_date' => '2009-01-15'],
                ['nis' => '4661', 'nisn' => '0094572949', 'full_name' => 'DAHLIA KASIH TRIANITA', 'birth_date' => '2009-01-25'],
                ['nis' => '4662', 'nisn' => '0098551066', 'full_name' => 'EKA KUSNAINI', 'birth_date' => '2009-08-03'],
                ['nis' => '4663', 'nisn' => '0094578059', 'full_name' => 'EVAND APRILLIANO', 'birth_date' => '2009-04-24'],
                ['nis' => '4664', 'nisn' => '0092979596', 'full_name' => 'FAHLEVI ALVIAN PERMANA', 'birth_date' => '2009-01-05'],
                ['nis' => '4665', 'nisn' => '0081668687', 'full_name' => 'FAHREZA DWI NURFAIZUM', 'birth_date' => '2008-10-27'],
                ['nis' => '4666', 'nisn' => '0097358120', 'full_name' => 'FANI SHABRINA RIHHADATUL AISY', 'birth_date' => '2009-03-30'],
                ['nis' => '4667', 'nisn' => '0082974011', 'full_name' => 'FAREL ADITYA KUSUMA', 'birth_date' => '2008-12-20'],
                ['nis' => '4668', 'nisn' => '0092355183', 'full_name' => 'IKE PUSPITASARI', 'birth_date' => '2009-06-27'],
                ['nis' => '4669', 'nisn' => '0096052768', 'full_name' => 'IMANUEL AYUB FLABIANOS', 'birth_date' => '2009-01-03'],
                ['nis' => '4670', 'nisn' => '0095066237', 'full_name' => 'KHUMAIRAH MAULIDA SYAFIRA', 'birth_date' => '2009-02-26'],
                ['nis' => '4671', 'nisn' => '0096584517', 'full_name' => 'LAILA SAILUNNAJAH', 'birth_date' => '2009-07-04'],
                ['nis' => '4672', 'nisn' => '0084701669', 'full_name' => 'LUKI DAMAR ADIYAKSA', 'birth_date' => '2008-10-02'],
                ['nis' => '4673', 'nisn' => '0089139738', 'full_name' => 'MAULANA YUSUF SEPTIYANSYAH', 'birth_date' => '2008-12-24'],
                ['nis' => '4674', 'nisn' => '3095583368', 'full_name' => 'MUHAMMAD GILANG RAMADHAN', 'birth_date' => '2009-09-08'],
                ['nis' => '4675', 'nisn' => '3098341856', 'full_name' => 'MUHAMMAD SIRO JAMMUNIRO', 'birth_date' => '2009-07-22'],
                ['nis' => '4676', 'nisn' => '0091935654', 'full_name' => 'MUHAMMAD WIBI DWI NUR APRILIAN', 'birth_date' => '2009-04-21'],
                ['nis' => '4677', 'nisn' => '0097106562', 'full_name' => 'MUKHAMMAD SHANDY IKHWAN MAULANA', 'birth_date' => '2009-08-24'],
                ['nis' => '4678', 'nisn' => '0089359633', 'full_name' => 'NIMAS DIANING KUMALASIWI', 'birth_date' => '2008-07-31'],
                ['nis' => '4679', 'nisn' => '0092428648', 'full_name' => 'PUTRI SALSA CHRISTINA', 'birth_date' => '2009-07-07'],
                ['nis' => '4680', 'nisn' => '0087321267', 'full_name' => 'RADHITYA DWI RIVALDO', 'birth_date' => '2008-12-28'],
                ['nis' => '4681', 'nisn' => '0094525193', 'full_name' => 'RAISAH ZAHWA QURRATU AINA', 'birth_date' => '2009-03-08'],
                ['nis' => '4682', 'nisn' => '0093766464', 'full_name' => 'RAYHANNATUN NAJLA', 'birth_date' => '2009-06-21'],
                ['nis' => '4683', 'nisn' => '0082303931', 'full_name' => 'RAYYAN QATRUNADA QHONIANSYAH PUTRA', 'birth_date' => '2008-07-15'],
                ['nis' => '4684', 'nisn' => '0086952233', 'full_name' => 'RENDI SURYA RAMADHAN', 'birth_date' => '2008-09-06'],
                ['nis' => '4685', 'nisn' => '0086866523', 'full_name' => 'REYKHAN DIKA IBNUL UULA', 'birth_date' => '2008-07-05'],
                ['nis' => '4686', 'nisn' => '0085030388', 'full_name' => 'RICO DWI PRASETYA', 'birth_date' => '2008-11-30'],
                ['nis' => '4687', 'nisn' => '0088001812', 'full_name' => 'SAKA DIVA ANANTA', 'birth_date' => '2008-07-29'],
                ['nis' => '4688', 'nisn' => '0097883770', 'full_name' => 'YEFRIKO EGA FERDIANTO', 'birth_date' => '2009-06-20'],
            ],
            'XII PPLG 2' => [
                ['nis' => '4689', 'nisn' => '0099090847', 'full_name' => 'ACHMAD AVREL ARRASYID', 'birth_date' => '2009-05-11'],
                ['nis' => '4690', 'nisn' => '0094811846', 'full_name' => 'AHMAD DARMAWAN', 'birth_date' => '2009-06-12'],
                ['nis' => '4691', 'nisn' => '0083220713', 'full_name' => 'AHMAD ROZIQIN', 'birth_date' => '2008-11-07'],
                ['nis' => '4692', 'nisn' => '0095389557', 'full_name' => 'ALFIAN REIHAN MAULANA ARDIANSYAH', 'birth_date' => '2009-03-04'],
                ['nis' => '4693', 'nisn' => '0092538607', 'full_name' => 'ARFAN ACHMAD APRILIANO', 'birth_date' => '2009-04-30'],
                ['nis' => '4694', 'nisn' => '0096353126', 'full_name' => 'ATIQA MAYZA SURAYYA', 'birth_date' => '2009-01-17'],
                ['nis' => '4695', 'nisn' => '3093084832', 'full_name' => 'CINDY AZAHRA MISHELLIA ALBA', 'birth_date' => '2008-11-27'],
                ['nis' => '4696', 'nisn' => '0084338067', 'full_name' => 'DAVA EKA SAPUTRA', 'birth_date' => '2008-08-02'],
                ['nis' => '4697', 'nisn' => '0096882789', 'full_name' => 'DZIRWATUL QOLBI', 'birth_date' => '2009-02-01'],
                ['nis' => '4698', 'nisn' => '0096148799', 'full_name' => 'FAHRI MAULANA LUKY PRASETYO', 'birth_date' => '2009-04-24'],
                ['nis' => '4699', 'nisn' => '0081263451', 'full_name' => 'HELMY YUNAN NASUTION', 'birth_date' => '2008-09-28'],
                ['nis' => '4700', 'nisn' => '0095477457', 'full_name' => 'INDI ALIQATUS SANIA', 'birth_date' => '2009-07-31'],
                ['nis' => '4701', 'nisn' => '0098438169', 'full_name' => 'KANIA ZAHRA ALISKHA', 'birth_date' => '2009-06-09'],
                ['nis' => '4702', 'nisn' => '0094371625', 'full_name' => 'KARERINA ATTHAULLAH DWI ZUMAR', 'birth_date' => '2009-07-31'],
                ['nis' => '4703', 'nisn' => '0094669346', 'full_name' => 'KEVIN YUDHA PRATAMA', 'birth_date' => '2009-10-09'],
                ['nis' => '4704', 'nisn' => '0071506198', 'full_name' => 'KEVYN TRI ANGGARA SAPUTRA', 'birth_date' => '2008-08-24'],
                ['nis' => '4705', 'nisn' => '0097047893', 'full_name' => 'MAISAH SILVA HANDAYANI', 'birth_date' => '2009-05-04'],
                ['nis' => '4706', 'nisn' => '3086349548', 'full_name' => 'MAULANA FAHRI OKTAVIAN', 'birth_date' => '2008-10-20'],
                ['nis' => '4707', 'nisn' => '0085919684', 'full_name' => 'MOCHAMMAD RAUL AR-RASYI', 'birth_date' => '2008-05-07'],
                ['nis' => '4708', 'nisn' => '0097024527', 'full_name' => 'MUHAMAD RIZKI UTAMA', 'birth_date' => '2009-02-04'],
                ['nis' => '4709', 'nisn' => '0093310662', 'full_name' => 'MUHAMMAD AFFRIZA LATIF', 'birth_date' => '2009-08-25'],
                ['nis' => '4710', 'nisn' => '0098107422', 'full_name' => 'MUHAMMAD EVAN PERMANA', 'birth_date' => '2009-05-07'],
                ['nis' => '4711', 'nisn' => '0081261124', 'full_name' => 'MUHAMMAD KRISNA FARIDIWA', 'birth_date' => '2008-08-27'],
                ['nis' => '4712', 'nisn' => '0096560887', 'full_name' => 'MUHAMMAD RAYHAN KHOIRUL AFIF', 'birth_date' => '2009-01-04'],
                ['nis' => '4713', 'nisn' => '0083463781', 'full_name' => 'MUHAMMAD SABRIAN NUH', 'birth_date' => '2008-12-30'],
                ['nis' => '4714', 'nisn' => '0081135817', 'full_name' => 'MUHAMMAD SALMAN ANFA\'UTTHAHIR', 'birth_date' => '2008-10-03'],
                ['nis' => '4715', 'nisn' => '0082164925', 'full_name' => 'MUHAMMAD SYAHRIL ROMADHON', 'birth_date' => '2008-08-29'],
                ['nis' => '4716', 'nisn' => '0094699541', 'full_name' => 'MUHAMMAD TAUFIQURROHMAN', 'birth_date' => '2009-06-07'],
                ['nis' => '4717', 'nisn' => '0095941378', 'full_name' => 'MUHAMMAD ZAINAL ARIEF', 'birth_date' => '2009-02-25'],
                ['nis' => '4718', 'nisn' => '0096031368', 'full_name' => 'NATASYA MEYLANI SAHPUTRI', 'birth_date' => '2009-05-15'],
                ['nis' => '4719', 'nisn' => '0099586117', 'full_name' => 'REDITA RAESYA FITRIA', 'birth_date' => '2009-07-07'],
                ['nis' => '4720', 'nisn' => '0083840897', 'full_name' => 'REFAN MAULANA', 'birth_date' => '2008-01-29'],
                ['nis' => '4721', 'nisn' => '0098434259', 'full_name' => 'REYNO ANDREAN WIJAKSONO', 'birth_date' => '2009-04-22'],
                ['nis' => '4722', 'nisn' => '0095359333', 'full_name' => 'SAFIRA DAMAYANTI', 'birth_date' => '2009-09-08'],
                ['nis' => '4723', 'nisn' => '0096584659', 'full_name' => 'VELLIA RAGIL SAPUTRI', 'birth_date' => '2009-05-07'],
                ['nis' => '4724', 'nisn' => '0106850128', 'full_name' => 'ZAHIDA ASHA FALIA', 'birth_date' => '2010-01-06'],
            ],
        ];

        $totalStudents = 0;

        foreach ($classes as $className => $students) {
            $classroom = ClassRoom::firstOrCreate(
                ['name' => $className],
                [
                    'major_id' => $major->id,
                    'code'     => str_replace(' ', '_', $className),
                    'grade'    => '12',
                ]
            );

            foreach ($students as $data) {
                // Cari data lama berdasarkan NISN lama ATAU NIS lokal (kalau sudah pernah di-update)
                $student = Student::whereIn('nis', [$data['nisn'], $data['nis']])->first();

                if ($student) {
                    // ✅ Data lama ketemu → ganti NIS-nya jadi NIS LOKAL
                    $student->update([
                        'nis'          => $data['nis'],
                        'classroom_id' => $classroom->id,
                        'full_name'    => $data['full_name'],
                        'birth_date'   => $data['birth_date'],
                    ]);
                    $user = User::find($student->user_id);
                } else {
                    // Data belum ada sama sekali → buat baru
                    $user = User::firstOrCreate(
                        ['email' => $data['nis'] . '@sikes.com'],
                        [
                            'name'     => $data['full_name'],
                            'password' => Hash::make('password'),
                            'status'   => 'active',
                        ]
                    );

                    Student::create([
                        'user_id'      => $user->id,
                        'classroom_id' => $classroom->id,
                        'nis'          => $data['nis'],
                        'full_name'    => $data['full_name'],
                        'birth_date'   => $data['birth_date'],
                    ]);
                }

                if ($user) {
                    $user->assignRole('siswa');
                }

                $totalStudents++;
            }
        }

        $this->command->info('✅ ' . $totalStudents . ' data siswa berhasil disimpan dengan NIS LOKAL!');
    }
}