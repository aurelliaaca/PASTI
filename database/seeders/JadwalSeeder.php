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
                // 'jadwalid' => 'PPL_A_2024', //karena increment jadi tidak perlu diberi jadwalid
                // nambahin kode prodi buat tabel persetujuan jadwal di dekan
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E101',
                'kelas' => 'A',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6504',
                'kuota' => 50,
                'koordinator' => 'Dio Nicolin, S.Si., M.T.',
                'pengampu1' => 'Prof. Dr. Priyo, S.Si., M.T',
                'pengampu2'=> 'Azizah Salsabila, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'PPL_B_2024', //karena increment jadi tidak perlu diberi jadwalid
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E101',
                'kelas' => 'B',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6504',
                'kuota' => 50,
                'koordinator' => 'Dio Nicolin, S.Si., M.T.',
                'pengampu1' => 'Prof. Dr. Priyo, S.Si., M.T',
                'pengampu2'=> 'Azizah Salsabila, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'PPL_C_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E101',
                'kelas' => 'C',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6504',
                'kuota' => 50,
                'koordinator' => 'Dio Nicolin, S.Si., M.T.',
                'pengampu1' => 'Prof. Dr. Priyo, S.Si., M.T',
                'pengampu2'=> 'Azizah Salsabila, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'PPL_D_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E101',
                'kelas' => 'D',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6504',
                'kuota' => 50,
                'koordinator' => 'Dio Nicolin, S.Si., M.T.',
                'pengampu1' => 'Prof. Dr. Priyo, S.Si., M.T',
                'pengampu2'=> 'Azizah Salsabila, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KTP_A_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E102',
                'kelas' => 'A',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator' => 'Dr. Ahmad Fadli, S.Si., M.Kom',
                'pengampu1' => 'Rahma Adhani, S.Si., M.T',
                'pengampu2'=> 'Roni Kurniawan, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KTP_B_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E102',
                'kelas' => 'B',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator' => 'Dr. Ahmad Fadli, S.Si., M.Kom',
                'pengampu1' => 'Rahma Adhani, S.Si., M.T',
                'pengampu2'=> 'Roni Kurniawan, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KTP_C_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E102',
                'kelas' => 'C',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator' => 'Dr. Ahmad Fadli, S.Si., M.Kom',
                'pengampu1' => 'Rahma Adhani, S.Si., M.T',
                'pengampu2'=> 'Roni Kurniawan, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KTP_D_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E102',
                'kelas' => 'D',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6502',
                'kuota' => 50,
                'koordinator' => 'Dr. Ahmad Fadli, S.Si., M.Kom',
                'pengampu1' => 'Rahma Adhani, S.Si., M.T',
                'pengampu2'=> 'Roni Kurniawan, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            // SI
            [
                // 'jadwalid' => 'SI_A_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'E103',
                'kelas' => 'A',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator' => 'Prof. Bambang Hartono, S.Si., M.Kom',
                'pengampu1' => 'Sri Utami, S.Kom., M.Kom.',
                'pengampu2' => 'Teguh Prakoso, S.Si., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [ 
                // 'jadwalid' => 'SI_B_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'E103',
                'kelas' => 'B',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator' => 'Prof. Bambang Hartono, S.Si., M.Kom',
                'pengampu1' => 'Sri Utami, S.Kom., M.Kom.',
                'pengampu2' => 'Teguh Prakoso, S.Si., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'SI_C_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'E103',
                'kelas' => 'C',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator' => 'Prof. Bambang Hartono, S.Si., M.Kom',
                'pengampu1' => 'Sri Utami, S.Kom., M.Kom.',
                'pengampu2' => 'Teguh Prakoso, S.Si., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'SI_D_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'E103',
                'kelas' => 'D',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6503',
                'kuota' => 50,
                'koordinator' => 'Prof. Bambang Hartono, S.Si., M.Kom',
                'pengampu1' => 'Sri Utami, S.Kom., M.Kom.',
                'pengampu2' => 'Teguh Prakoso, S.Si., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            // // ML
            [
                // 'jadwalid' => 'ML_A_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'A303',
                'kelas' => 'A',
                'hari' => 'Selasa',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu1' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'pengampu2' => 'Anita Maharani, S.Kom., M.T.',
                'status' => 'belum disetujui' //menambahkan status persetujuan

            ],
            [
                // 'jadwalid' => 'ML_B_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'A303',
                'kelas' => 'B',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu1' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'pengampu2' => 'Anita Maharani, S.Kom., M.T.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'ML_C_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'A303',
                'kelas' => 'C',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu1' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'pengampu2' => 'Anita Maharani, S.Kom., M.T.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'ML_D_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'A303',
                'kelas' => 'D',
                'hari' => 'Senin',
                'kodemk' => 'PAIK6505',
                'kuota' => 50,
                'koordinator' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu1' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'pengampu2' => 'Anita Maharani, S.Kom., M.T.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            //PBP
            [
                // 'jadwalid' => 'PBP_A_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E101',
                'kelas' => 'A',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6501',
                'kuota' => 50,
                'koordinator' => 'Dr. Lestari Widyanigrum, S.Kom., M.Kom.',
                'pengampu1' => 'Setiawan Saputra, S.Kom., M.Kom.',
                'pengampu2' => 'Arif Wibowo, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'PBP_B_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E101',
                'kelas' => 'B',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6501',
                'kuota' => 50,
                'koordinator' => 'Dr. Lestari Widyanigrum, S.Kom., M.Kom.',
                'pengampu1' => 'Setiawan Saputra, S.Kom., M.Kom.',
                'pengampu2' => 'Arif Wibowo, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'PBP_C_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E101',
                'kelas' => 'C',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6501',
                'kuota' => 50,
                'koordinator' => 'Dr. Lestari Widyanigrum, S.Kom., M.Kom.',
                'pengampu1' => 'Setiawan Saputra, S.Kom., M.Kom.',
                'pengampu2' => 'Arif Wibowo, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'PBP_D_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E101',
                'kelas' => 'D',
                'hari' => 'Rabu',
                'kodemk' => 'PAIK6501',
                'kuota' => 50,
                'koordinator' => 'Dr. Lestari Widyanigrum, S.Kom., M.Kom.',
                'pengampu1' => 'Setiawan Saputra, S.Kom., M.Kom.',
                'pengampu2' => 'Arif Wibowo, S.Kom., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            // KJI
            [
                // 'jadwalid' => 'KJI_A_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'E102',
                'kelas' => 'A',
                'hari' => 'Jumat',
                'kodemk' => 'PAIK6506',
                'kuota' => 50,
                'koordinator' => 'Rahma Adhani, S.Si., M.T.',
                'pengampu1' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu2' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KJI_B_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E102',
                'kelas' => 'B',
                'hari' => 'Jumat',
                'kodemk' => 'PAIK6506',
                'kuota' => 50,
                'koordinator' => 'Rahma Adhani, S.Si., M.T.',
                'pengampu1' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu2' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KJI_C_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E102',
                'kelas' => 'C',
                'hari' => 'Jumat',
                'kodemk' => 'PAIK6506',
                'kuota' => 50,
                'koordinator' => 'Rahma Adhani, S.Si., M.T.',
                'pengampu1' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu2' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KJI_D_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E102',
                'kelas' => 'D',
                'hari' => 'Kamis',
                'kodemk' => 'PAIK6506',
                'kuota' => 50,
                'koordinator' => 'Rahma Adhani, S.Si., M.T.',
                'pengampu1' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'pengampu2' => 'Aditya Kurniawan, S.Si., M.Kom.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KWU_A_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E103',
                'kelas' => 'A',
                'hari' => 'Jumat',
                'kodemk' => 'UNW00007',
                'kuota' => 50,
                'koordinator' => 'Prof. Dimas Surya, S.Si., M.Kom.',
                'pengampu1' => 'Rizky Pratama, S.Si., M.Kom.',
                'pengampu2' => 'Prof. Dr. Priyo, S.Si., M.T.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KWU_B_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '13:00:00',
                'ruangan' => 'E103',
                'kelas' => 'B',
                'hari' => 'Jumat',
                'kodemk' => 'UNW00007',
                'kuota' => 50,
                'koordinator' => 'Prof. Dimas Surya, S.Si., M.Kom.',
                'pengampu1' => 'Rizky Pratama, S.Si., M.Kom.',
                'pengampu2' => 'Prof. Dr. Priyo, S.Si., M.T.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KWU_C_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '07:00:00',
                'ruangan' => 'E103',
                'kelas' => 'C',
                'hari' => 'Kamis',
                'kodemk' => 'UNW00007',
                'kuota' => 50,
                'koordinator' => 'Prof. Dimas Surya, S.Si., M.Kom.',
                'pengampu1' => 'Rizky Pratama, S.Si., M.Kom.',
                'pengampu2' => 'Prof. Dr. Priyo, S.Si., M.T.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ],
            [
                // 'jadwalid' => 'KWU_D_2024',
                'kodeprodi' => 'E',
                'jam_mulai' => '09:40:00',
                'ruangan' => 'E103',
                'kelas' => 'D',
                'hari' => 'Jumat',
                'kodemk' => 'UNW00007',
                'kuota' => 50,
                'koordinator' => 'Prof. Dimas Surya, S.Si., M.Kom.',
                'pengampu1' => 'Rizky Pratama, S.Si., M.Kom.',
                'pengampu2' => 'Prof. Dr. Priyo, S.Si., M.T.',
                'status' => 'belum disetujui' //menambahkan status persetujuan
            ]
        ];
        DB::table('jadwal_mata_kuliah')->insert($jadwal);
    }
}