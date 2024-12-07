<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal_mata_kuliah;
use App\Models\Ruangan;
use App\Models\Dosen;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen = Dosen::first();
        if (!$dosen) {
            return;
        }

        $jadwal = [
            [
                'kodeprodi' => 'E',
                'kodemk' => 'PAIK6504',
                'hari' => 'Senin',
                'jam_mulai' => '07:00',
                'kelas' => 'A',
                'namaruang' => 'E101',
                'koordinator_nip' => $dosen->nip,
                'pengampu1_nip' => $dosen->nip,
                'pengampu2_nip' => $dosen->nip,
                'kuota' => 50,
                'status' => 'belum disetujui',
                'jam_selesai' => Carbon::createFromTimeString('07:00')->addMinutes(150)->format('H:i')
            ]
        ];

        foreach ($jadwal as $j) {
            Jadwal_mata_kuliah::create($j);
        }
    }
} 