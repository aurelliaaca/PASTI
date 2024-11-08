<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'alamat' => 'Jl. Bulusan Utara No. 41, Tembalang, Semarang',
                'dosenwali' => '123456789012345678' // Example NIP for dosenwali
            ],
            [
                'nama' => 'Tera Makna Pratiwi',
                'nim' => '24060122140120',
                'smt' => 5,
                'telp' => '0829989569409',
                'email' => 'tera@students.com',
                'alamat' => 'Jl. Banjarsari Selatan No. 90, Tembalang, Semarang',
                'dosenwali' => '987654321098765432' // Example NIP for dosenwali
            ],
        ];
        DB::table('mahasiswa')->insert($mahasiswa);
    }
}