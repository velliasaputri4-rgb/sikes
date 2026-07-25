<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicineCategory;

class MedicineCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tablet'],
            ['name' => 'Sirup'],
            ['name' => 'Salep/Krim'],
            ['name' => 'Alat Kesehatan'],
            ['name' => 'Vitamin/Suplemen'],
            ['name' => 'Antibiotik'],
            ['name' => 'Analgesik/Antipiretik'],
        ];

        foreach ($categories as $cat) {
            // firstOrCreate akan melewatkan jika nama sudah ada, mencegah duplikat
            MedicineCategory::firstOrCreate($cat);
        }

        $this->command->info('✅ Kategori obat berhasil ditambahkan!');
    }
}