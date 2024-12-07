<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use Carbon\Carbon;
use App\Models\Jadwal_mata_kuliah;

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

        $jadwals = [
            [
                'kodeprodi' => 'E',
                'kodemk' => 'PAIK6504',
                'hari' => 'Senin',
                'jam_mulai' => '07:00',
                'kelas' => 'A',
                'ruang_id' => '1',
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
                'ruang_id' => '1',
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
                'ruang_id' => '1',
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
                'ruang_id' => '1',
                'koordinator_nip' => $koordinator,
                'pengampu1_nip' => $pengampu1,
                'pengampu2_nip' => $pengampu2,
                'kuota' => 50,
                'status' => 'belum disetujui',
                'jam_selesai' => Carbon::createFromTimeString('13:00')->addMinutes(150)->format('H:i')
            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruang_id' => '1',
                'kelas' => 'A',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruang_id' => '1',
                'kelas' => 'B',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruang_id' => '1',
                'kelas' => 'C',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruang_id' => '1',
                'kelas' => 'D',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            // SI
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => '1',
                'kelas' => 'A',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [ 
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => '1',
                'kelas' => 'B',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => '1',
                'kelas' => 'C',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => '2',
                'kelas' => 'D',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            // ML
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => '2',
                'kelas' => 'A',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => '2',
                'kelas' => 'B',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => '1',
                'kelas' => 'C',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => 'F201',
                'kelas' => 'D',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            //PBP
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruang_id' => '1',
                'kelas' => 'A',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6501',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruang_id' => '2',
                'kelas' => 'B',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6501',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruang_id' => '1',
                'kelas' => 'C',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6501',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruang_id' => '1',
                'kelas' => 'D',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6501',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            // KJI
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruang_id' => '2',
                'kelas' => 'A',
                'hari' => 'Jumat',
                'kodemk' => 'PAIK6506',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruang_id' => '2',
                'kelas' => 'B',
                'hari' => 'Jumat',
                'kodemk' => 'PAIK6506',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruang_id' => '1',
                'kelas' => 'C',
                'hari' => 'Jumat',
                'kodemk' => 'PAIK6506',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruang_id' => '1',
                'kelas' => 'D',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6506',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruang_id' => '1',
                'kelas' => 'A',
                'hari' => 'Jumat',
                'kodemk' => 'UNW00007',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',
            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruang_id' => '3',
                'kelas' => 'B',
                'hari' => 'Jumat',
                'kodemk' => 'UNW00007',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',

            ],
            [
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruang_id' => '3',
                'kelas' => 'C',
                'hari' => 'Kamis',
                'kodemk' => 'UNW00007',
                'kuota' => 50,
                'koordinator_nip' => '197505152005012001',
            ],
            [
                'kodeprodi' => 'E',
                'kodemk' => 'UNW00007',
                'hari' => 'Jumat',
                'jam_mulai' => '09:40',
                'kelas' => 'D',
                'ruang_id' => 3,
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