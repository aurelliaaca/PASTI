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
        if (count($dosen) < 3) {
            throw new \Exception('Minimal harus ada 3 dosen di database');
        }

        // Jika dosen kurang dari yang dibutuhkan, gunakan yang ada dengan pengulangan
        // $koordinator = $dosen[array_rand($dosen)];
        // $pengampu1 = $dosen[array_rand($dosen)];
        // $pengampu2 = $dosen[array_rand($dosen)];

        // // Pastikan dosen yang dipilih berbeda
        // while ($pengampu1 === $koordinator) {
        //     $pengampu1 = $dosen[array_rand($dosen)];
        // }
        
        // while ($pengampu2 === $koordinator || $pengampu2 === $pengampu1) {
        //     $pengampu2 = $dosen[array_rand($dosen)];
        // }
        
        // if (!$koordinator) {
        //     throw new \Exception('Minimal harus ada 1 dosen di database');
        // }

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

            //smt 1
            ['kodemk' => 'UUW00003', 'namaruang' => 'E101', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6102', 'namaruang' => 'E101', 'kelas' => 'A'],
            ['kodemk' => 'UUW00005', 'namaruang' => 'E101', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6103', 'namaruang' => 'E101', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6104', 'namaruang' => 'E101', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6105', 'namaruang' => 'E101', 'kelas' => 'A'],
            ['kodemk' => 'UUW00007', 'namaruang' => 'E101', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6101', 'namaruang' => 'E101', 'kelas' => 'A'],

            //smt 2
            ['kodemk' => 'UUW00004', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6202', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'UUW00011', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6203', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6204', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'PAIK6201', 'namaruang' => 'E102', 'kelas' => 'A'],
            ['kodemk' => 'UUW00006', 'namaruang' => 'E102', 'kelas' => 'A'],
        ];

        // Menyimpan kombinasi dosen untuk setiap kodemk
        $kombinasiDosenPerKodamk = [];
        $jadwals = [];
        

        foreach ($baseJadwal as $jadwal) {
            // Pilih kombinasi dosen acak (koordinator, pengampu1, pengampu2)
            if (!isset($kombinasiDosenPerKodamk[$jadwal['kodemk']])) {
                // Pilih 3 dosen acak dari seluruh dosen
                $availableDosen = $dosen;  // Menggunakan seluruh dosen yang ada
                shuffle($availableDosen);  // Acak urutan dosen
                
                // Pilih 3 dosen acak dari availableDosen
                $selectedDosen = array_slice($availableDosen, 0, 3);
                $koordinator = $selectedDosen[0];  // Koordinator
                $pengampu1 = $selectedDosen[1];    // Pengampu 1
                $pengampu2 = $selectedDosen[2];    // Pengampu 2
                
                // Simpan kombinasi dosen untuk kodemk ini
                $kombinasiDosenPerKodamk[$jadwal['kodemk']] = [
                    'koordinator' => $koordinator,
                    'pengampu1' => $pengampu1,
                    'pengampu2' => $pengampu2
                ];
            } else {
                // Ambil kombinasi dosen yang sudah disimpan untuk kodemk ini
                $koordinator = $kombinasiDosenPerKodamk[$jadwal['kodemk']]['koordinator'];
                $pengampu1 = $kombinasiDosenPerKodamk[$jadwal['kodemk']]['pengampu1'];
                $pengampu2 = $kombinasiDosenPerKodamk[$jadwal['kodemk']]['pengampu2'];
            }

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
                'status' => 'sudah disetujui',
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