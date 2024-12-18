<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matkul = [
            [
                'nama' => 'Struktur Data',
                'kode' => 'PAIK6301',
                'sks' => '4',
                'status' => 'wajib',
                'semester'=> '4',
            ],
            [
                'nama' => 'Metode Numerik',
                'kode' => 'PAIK6304',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '3',
            ],
            [
                'nama' => 'Sistem Operasi',
                'kode' => 'PAIK6302',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '3',
            ],
            [
                'nama' => 'Interaksi Manusia dan Komputer',
                'kode' => 'PAIK6305',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '3',
            ],
            [
                'nama' => 'Basis Data',
                'kode' => 'PAIK6303',
                'sks' => '4',
                'status' => 'wajib',
                'semester'=> '3',
            ],
            [
                'nama' => 'Statistika',
                'kode' => 'PAIK6306',
                'sks' => '2',
                'status' => 'wajib',
                'semester'=> '3',
            ],
            [
                'nama' => 'Sistem Informasi',
                'kode' => 'PAIK6503',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '5',
            ],
            [
                'nama' => 'Kewirausahaan',
                'kode' => 'UNW00007',
                'sks' => '2',
                'status' => 'wajib',
                'semester'=> '4',
            ],
            [
                'nama' => 'Proyek Perangkat Lunak',
                'kode' => 'PAIK6504',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '5',
            ],
            [
                'nama' => 'Keamanan dan Jaminan Informasi',
                'kode' => 'PAIK6506',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '5',
            ],
            [
                'nama' => 'Pengembangan Berbasis Platform',
                'kode' => 'PAIK6501',
                'sks' => '4',
                'status' => 'wajib',
                'semester'=> '5',
            ],
            [
                'nama' => 'Komputasi Tersebar dan Paralel',
                'kode' => 'PAIK6502',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '5',
            ],
            [
                'nama' => 'Pembelajaran Mesin',
                'kode' => 'PAIK6505',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '5',
            ],
            [
                'nama' => 'Pancasila dan Kewarganegaraan',
                'kode' => 'UUW00003',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '1',
            ],
            [
                'nama' => 'Dasar Pemrograman',
                'kode' => 'PAIK6102',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '1',
            ],
            [
                'nama' => 'Olahraga',
                'kode' => 'UUW00005',
                'sks' => '1',
                'status' => 'wajib',
                'semester'=> '1',
            ],
            [
                'nama' => 'Dasar Sistem',
                'kode' => 'PAIK6103',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '1',
            ],
            [
                'nama' => 'Logika Informatika',
                'kode' => 'PAIK6104',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '1',
            ],
            [
                'nama' => 'Struktur Diskrit',
                'kode' => 'PAIK6105',
                'sks' => '4',
                'status' => 'wajib',
                'semester'=> '1',
            ],
            [
                'nama' => 'Bahasa Inggris',
                'kode' => 'UUW00007',
                'sks' => '2',
                'status' => 'wajib',
                'semester'=> '1',
            ],
            [
                'nama' => 'Matematika I',
                'kode' => 'PAIK6101',
                'sks' => '2',
                'status' => 'wajib',
                'semester'=> '1',
            ],
            [
                'nama' => 'Bahasa Indonesia',
                'kode' => 'UUW00004',
                'sks' => '2',
                'status' => 'wajib',
                'semester'=> '2',
            ],
            [
                'nama' => 'Algoritma dan Pemrograman',
                'kode' => 'PAIK6202',
                'sks' => '4',
                'status' => 'wajib',
                'semester'=> '2',
            ],
            [
                'nama' => 'Pendidikan Agama Islam',
                'kode' => 'UUW00011',
                'sks' => '2',
                'status' => 'wajib',
                'semester'=> '2',
            ],
            [
                'nama' => 'Organisasi dan Arsitektur Komputer',
                'kode' => 'PAIK6203',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '2',
            ],
            [
                'nama' => 'Aljabar Linier',
                'kode' => 'PAIK6204',
                'sks' => '3',
                'status' => 'wajib',
                'semester'=> '2',
            ],
            [
                'nama' => 'Matematika II',
                'kode' => 'PAIK6201',
                'sks' => '2',
                'status' => 'wajib',
                'semester'=> '2',
            ],
            [
                'nama' => 'Internet of Things (IoT)',
                'kode' => 'UUW00006',
                'sks' => '2',
                'status' => 'wajib',
                'semester'=> '2',
            ],

        ];
        DB::table('matakuliah')->insert($matkul);
    }
}