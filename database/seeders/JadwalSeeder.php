<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use Carbon\Carbon;
use App\Models\Jadwal_mata_kuliah;

class JadwalSeeder extends Seeder
{
    private function getRandomTime()
    {
        // Membuat array waktu yang tersedia (07:00 - 19:00 dengan interval 30 menit)
        $times = [];
        $start = Carbon::createFromTime(7, 0);
        $end = Carbon::createFromTime(19, 0);
        
        while ($start <= $end) {
            $times[] = $start->format('H:i');
            $start->addMinutes(30);
        }
        
        return $times[array_rand($times)];
    }

    private function getRandomDay()
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        return $days[array_rand($days)];
    }

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

        $baseJadwal = [
            // PAIK6501 (PBP)
            ['kodemk' => 'PAIK6501', 'namaruang' => 'E101', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6501', 'namaruang' => 'E101', 'kelas' => 'B'],
            ['kodemk' => 'PAIK6501', 'namaruang' => 'E101', 'kelas' => 'C'],
            ['kodemk' => 'PAIK6501', 'namaruang' => 'E101', 'kelas' => 'D'],
            
            // PAIK6502
            ['kodemk' => 'PAIK6502', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6502', 'namaruang' => 'E102', 'kelas' => 'B'],
            ['kodemk' => 'PAIK6502', 'namaruang' => 'E102', 'kelas' => 'C'],
            ['kodemk' => 'PAIK6502', 'namaruang' => 'E102', 'kelas' => 'D'],
            
            // PAIK6503 (SI)
            ['kodemk' => 'PAIK6503', 'namaruang' => 'E103', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6503', 'namaruang' => 'E103', 'kelas' => 'B'],
            ['kodemk' => 'PAIK6503', 'namaruang' => 'E103', 'kelas' => 'C'],
            ['kodemk' => 'PAIK6503', 'namaruang' => 'E103', 'kelas' => 'D'],
            
            // PAIK6504
            ['kodemk' => 'PAIK6504', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6504', 'namaruang' => 'E103', 'kelas' => 'B'],
            ['kodemk' => 'PAIK6504', 'namaruang' => 'E103', 'kelas' => 'C'],
            ['kodemk' => 'PAIK6504', 'namaruang' => 'E103', 'kelas' => 'D'],
            
            // PAIK6505 (ML)
            ['kodemk' => 'PAIK6505', 'namaruang' => 'F201', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6505', 'namaruang' => 'F201', 'kelas' => 'B'],
            ['kodemk' => 'PAIK6505', 'namaruang' => 'F201', 'kelas' => 'C'],
            ['kodemk' => 'PAIK6505', 'namaruang' => 'F201', 'kelas' => 'D'],
            
            // PAIK6506 (KJI)
            ['kodemk' => 'PAIK6506', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6506', 'namaruang' => 'E102', 'kelas' => 'B'],
            ['kodemk' => 'PAIK6506', 'namaruang' => 'E102', 'kelas' => 'C'],
            ['kodemk' => 'PAIK6506', 'namaruang' => 'E102', 'kelas' => 'D'],
            
            // UNW00007
            ['kodemk' => 'UNW00007', 'namaruang' => 'E103', 'kelas' => 'A'],
            ['kodemk' => 'UNW00007', 'namaruang' => 'E103', 'kelas' => 'B'],
            ['kodemk' => 'UNW00007', 'namaruang' => 'E103', 'kelas' => 'C'],
            ['kodemk' => 'UNW00007', 'namaruang' => 'E103', 'kelas' => 'D'],
        ];

        $jadwals = [];
        foreach ($baseJadwal as $jadwal) {
            $jamMulai = $this->getRandomTime();
            $durasi = $jadwal['kodemk'] === 'UNW00007' ? 100 : 150;
            
            $jadwals[] = [
                'kodeprodi' => 'E',
                'kodemk' => $jadwal['kodemk'],
                'hari' => $this->getRandomDay(),
                'jam_mulai' => $jamMulai,
                'kelas' => $jadwal['kelas'],
                'namaruang' => $jadwal['namaruang'],
                'koordinator_nip' => $koordinator,
                'pengampu1_nip' => $pengampu1,
                'pengampu2_nip' => $pengampu2,
                'kuota' => 50,
                'status' => 'belum disetujui',
                'jam_selesai' => Carbon::createFromTimeString($jamMulai)->addMinutes($durasi)->format('H:i')
            ];
        }

        // Urutkan berdasarkan kodemk
        usort($jadwals, function($a, $b) {
            return $a['kodemk'] <=> $b['kodemk'];
        });

        foreach ($jadwals as $jadwal) {
            DB::table('jadwal_mata_kuliah')->insert($jadwal);
        }
    }
}