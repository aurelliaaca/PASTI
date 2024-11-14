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
                'prodi' => 'S1 Informatika', //baru
                'dosenwali' => '197505152005012001' 
            ],
            [
                'nama' => 'Tera Makna Pratiwi',
                'nim' => '24060122140120',
                'smt' => 5,
                'telp' => '0829989569409',
                'email' => 'tera@students.com',
                'alamat' => 'Jl. Banjarsari Selatan No. 90, Tembalang, Semarang',
                'prodi' => 'S1 Informatika',
                'dosenwali' => '197505152005012001' 
            ],
            [
                'nama' => 'Aurellia Putri Budi',
                'nim' => '24060123140168',
                'smt' => 3,
                'telp' => '082876569889',
                'email' => 'aurel@students.com',
                'alamat' => 'Jl. Mulawarman, Tembalang, Semarang',
                'prodi' => 'S1 Informatika',
                'dosenwali' => '198910182005012002'
            ],
            [
                'nama' => 'Nabila Najma Manika',
                'nim' => '24060123140172',
                'smt' => 3,
                'telp' => '085899577422',
                'email' => 'nabila@students.com',
                'alamat' => 'Jl. Bulusan Selatan No. 90, Tembalang, Semarang',
                'prodi' => 'S1 Informatika',
                'dosenwali' => '198910182005012002'
            ]
        ];
        DB::table('mahasiswa')->insert($mahasiswa);
    }
}