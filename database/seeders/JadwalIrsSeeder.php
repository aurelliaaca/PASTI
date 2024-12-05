<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JadwalIrs;

class JadwalIrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwal_irs = [
            ['keterangan' => 'Periode 1', 'jadwal_mulai' => '2024-01-01', 'jadwal_berakhir' => '2024-01-10'],
            ['keterangan' => 'Periode 2', 'jadwal_mulai' => '2024-01-10', 'jadwal_berakhir' => '2024-01-20'],
        ];

        foreach ($jadwal_irs as $j) {
            JadwalIrs::create($j);
        }
    }
}
