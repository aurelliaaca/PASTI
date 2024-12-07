<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use App\Models\Ruangan;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data dosen yang ada
        $dosen = Dosen::pluck('nip')->toArray();
        
        // Jika dosen kurang dari yang dibutuhkan, gunakan yang ada dengan pengulangan
        $koordinator = $dosen[0] ?? null;
        $pengampu1 = $dosen[1] ?? $dosen[0] ?? null;
        $pengampu2 = $dosen[2] ?? $dosen[0] ?? null;
        
        if (!$koordinator) {
            throw new \Exception('Minimal harus ada 1 dosen di database');
        }

        // Ambil kode ruangan yang ada (bukan ID)
        $ruang = Ruangan::first()->ruang ?? null;
        
        if (!$ruang) {
            throw new \Exception('Minimal harus ada 1 ruangan di database');
        }

        $jadwals = [
            [
                'kodeprodi' => 'E',
                'kodemk' => 'PAIK6504',
                'hari' => 'Senin',
                'jam_mulai' => '07:00',
                'kelas' => 'A',
                'ruang_id' => $ruang,
                'koordinator_nip' => $koordinator,
                'pengampu1_nip' => $pengampu1,
                'pengampu2_nip' => $pengampu2,
                'kuota' => 50,
                'status' => 'belum disetujui',
                'jam_selesai' => Carbon::createFromTimeString('07:00')->addMinutes(150)->format('H:i')
            ],
            [
                'kodeprodi' => 'E',
                'kodemk' => 'PAIK6504',
                'hari' => 'Senin',
                'jam_mulai' => '13:00',
                'kelas' => 'B',
                'ruang_id' => $ruang,
                'koordinator_nip' => $koordinator,
                'pengampu1_nip' => $pengampu1,
                'pengampu2_nip' => $pengampu2,
                'kuota' => 50,
                'status' => 'belum disetujui',
                'jam_selesai' => Carbon::createFromTimeString('13:00')->addMinutes(150)->format('H:i')
            ],
            [
                'kodeprodi' => 'E',
                'kodemk' => 'PAIK6504',
                'hari' => 'Selasa',
                'jam_mulai' => '07:00',
                'kelas' => 'C',
                'ruang_id' => $ruang,
                'koordinator_nip' => $koordinator,
                'pengampu1_nip' => $pengampu1,
                'pengampu2_nip' => $pengampu2,
                'kuota' => 50,
                'status' => 'belum disetujui',
                'jam_selesai' => Carbon::createFromTimeString('07:00')->addMinutes(150)->format('H:i')
            ],
            [
                'kodeprodi' => 'E',
                'kodemk' => 'PAIK6504',
                'hari' => 'Selasa',
                'jam_mulai' => '13:00',
                'kelas' => 'D',
                'ruang_id' => $ruang,
                'koordinator_nip' => $koordinator,
                'pengampu1_nip' => $pengampu1,
                'pengampu2_nip' => $pengampu2,
                'kuota' => 50,
                'status' => 'belum disetujui',
                'jam_selesai' => Carbon::createFromTimeString('13:00')->addMinutes(150)->format('H:i')
            ],
            [
                'kodeprodi' => 'E',
                'kodemk' => 'UNW00007',
                'hari' => 'Jumat',
                'jam_mulai' => '09:40',
                'kelas' => 'D',
                'ruang_id' => $ruang,
                'koordinator_nip' => $koordinator,
                'pengampu1_nip' => $pengampu1,
                'pengampu2_nip' => $pengampu2,
                'kuota' => 50,
                'status' => 'belum disetujui',
                'jam_selesai' => Carbon::createFromTimeString('09:40')->addMinutes(100)->format('H:i')
            ],
        ];

        foreach ($jadwals as $jadwal) {
            DB::table('jadwal_mata_kuliah')->insert($jadwal);
        }
    }
}