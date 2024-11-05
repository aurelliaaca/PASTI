<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan DB facade diimpor

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = [
            [
                'nama' => 'Dhela Revaline',
                'nim' => '24060122130078',
                'smt' => 5,
                'telp' => '081559569409',
                'email' => 'dhela@students.com',
                'alamat' => 'Jl. Bulusan Utara No. 41, Tembalang, Semarang'
            ],
            [
                'nama' => 'Tera Makna Pratiwi',
                'nim' => '24060122140120',
                'smt' => 5,
                'telp' => '0829989569409',
                'email' => 'tera@students.com',
                'alamat' => 'Jl. Banjarsari Selatan No. 90, Tembalang, Semarang'
            ],
        ];
        DB::table('mahasiswa')->insert($mahasiswa);
    }
}
