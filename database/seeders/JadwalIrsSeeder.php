<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalIrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\JadwalIrs::create([
            'keterangan' => 'Jadwal Contoh',
            'jadwalmulai' => '2024-01-01',
            'jadwalberakhir' => '2024-01-10',
        ]);
    }
}
