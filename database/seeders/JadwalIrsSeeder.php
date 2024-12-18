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
            ['keterangan' => 'Periode Pengisian IRS', 'jadwal_mulai' => '2024-12-01', 'jadwal_berakhir' => '2025-01-01'],
            ['keterangan' => 'Periode Perubahan IRS', 'jadwal_mulai' => '2025-01-08', 'jadwal_berakhir' => '2025-01-22'],
            ['keterangan' => 'Periode Pembatalan IRS', 'jadwal_mulai' => '2025-01-29', 'jadwal_berakhir' => '2025-02-05'],
        ];

        foreach ($jadwal_irs as $j) {
            JadwalIrs::create($j);
        }
    }
}
