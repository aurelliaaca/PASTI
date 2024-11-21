<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwal = [
            // PPL
            [
                'jadwalid' => 'PPL_A_2024',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E101',
                'kelas' => 'A',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6504',
                'kuota' => 50,
                'koordinator' => 'Dio Nicolin, S.Si., M.T.',
                'pengampu1' => 'Prof. Dr. Priyo, S.Si., M.T',
                'pengampu2'=> 'Azizah Salsabila, S.Kom., M.Kom.',
            ],
            [
                'jadwalid' => 'PPL_B_2024',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E101',
                'kelas' => 'B',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6504',
                'kuota' => 50,
                'koordinator' => 'Dio Nicolin, S.Si., M.T.',
                'pengampu1' => 'Prof. Dr. Priyo, S.Si., M.T',
                'pengampu2'=> 'Azizah Salsabila, S.Kom., M.Kom.',
            ],
            [
                'jadwalid' => 'PPL_C_2024',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E101',
                'kelas' => 'C',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6504',
                'kuota' => 50,
                'koordinator' => 'Dio Nicolin, S.Si., M.T.',
                'pengampu1' => 'Prof. Dr. Priyo, S.Si., M.T',
                'pengampu2'=> 'Azizah Salsabila, S.Kom., M.Kom.',
            ],
            [
                'jadwalid' => 'PPL_D_2024',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E101',
                'kelas' => 'D',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6504',
                'kuota' => 50,
                'koordinator' => 'Dio Nicolin, S.Si., M.T.',
                'pengampu1' => 'Prof. Dr. Priyo, S.Si., M.T',
                'pengampu2'=> 'Azizah Salsabila, S.Kom., M.Kom.',
            ],
            // KTP
            [
                'jadwalid' => 'KTP_A_2024',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E102',
                'kelas' => 'A',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator' => 'Dr. Ahmad Fadli, S.Si., M.Kom',
                'pengampu1' => 'Rahma Adhani, S.Si., M.T',
                'pengampu2'=> 'Roni Kurniawan, S.Kom., M.Kom.',
            ],
            [
                'jadwalid' => 'KTP_B_2024',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E102',
                'kelas' => 'B',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator' => 'Dr. Ahmad Fadli, S.Si., M.Kom',
                'pengampu1' => 'Rahma Adhani, S.Si., M.T',
                'pengampu2'=> 'Roni Kurniawan, S.Kom., M.Kom.',
            ],
            [
                'jadwalid' => 'KTP_C_2024',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E102',
                'kelas' => 'C',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator' => 'Dr. Ahmad Fadli, S.Si., M.Kom',
                'pengampu1' => 'Rahma Adhani, S.Si., M.T',
                'pengampu2'=> 'Roni Kurniawan, S.Kom., M.Kom.',
            ],
            [
                'jadwalid' => 'KTP_D_2024',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E102',
                'kelas' => 'D',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator' => 'Dr. Ahmad Fadli, S.Si., M.Kom',
                'pengampu1' => 'Rahma Adhani, S.Si., M.T',
                'pengampu2'=> 'Roni Kurniawan, S.Kom., M.Kom.',
            ],
            // SI
            [
                'jadwalid' => 'SI_A_2024',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'E103',
                'kelas' => 'A',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator' => 'Prof. Bambang Hartono, S.Si., M.Kom',
                'pengampu1' => 'Sri Utami, S.Kom., M.Kom.',
                'pengampu2' => 'Teguh Prakoso, S.Si., M.Kom.'
            ],
            [
                'jadwalid' => 'SI_B_2024',
                'jam_mulai' => '15:40:00',
                'ruangan' => 'E103',
                'kelas' => 'B',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator' => 'Prof. Bambang Hartono, S.Si., M.Kom',
                'pengampu1' => 'Sri Utami, S.Kom., M.Kom.',
                'pengampu2' => 'Teguh Prakoso, S.Si., M.Kom.'
            ],
            [
                'jadwalid' => 'SI_C_2024',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'E103',
                'kelas' => 'C',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator' => 'Prof. Bambang Hartono, S.Si., M.Kom',
                'pengampu1' => 'Sri Utami, S.Kom., M.Kom.',
                'pengampu2' => 'Teguh Prakoso, S.Si., M.Kom.'
            ],
            [
                'jadwalid' => 'SI_D_2024',
                'jam_mulai' => '15:40:00',
                'ruangan' => 'E103',
                'kelas' => 'D',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator' => 'Prof. Bambang Hartono, S.Si., M.Kom',
                'pengampu1' => 'Sri Utami, S.Kom., M.Kom.',
                'pengampu2' => 'Teguh Prakoso, S.Si., M.Kom.'
            ],
            // ML
            [
                'jadwalid' => 'ML_A_2024',
                'jam_mulai' => '15:40:00',
                'ruangan' => 'A303',
                'kelas' => 'A',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu1' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'pengampu2' => 'Anita Maharani, S.Kom., M.T.'
            ],

        ];
        DB::table('jadwal_mata_kuliah')->insert($jadwal);
    }
}