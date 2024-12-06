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
                'smt' => 1,
                'IPK' => NULL,
                'IPS_Sebelumnya' => NULL,
                'telp' => '081559569409',
                'email' => 'dhela@students.com',
                'alamat' => 'Jl. Bulusan Utara No. 41, Tembalang, Semarang',
                'status' => '1',
                'prodi' => 'Informatika',
                'dosenwali' => '197505152005012001' //kamaruddin
            ],
            [
                'nama' => 'Tera Makna Pratiwi',
                'nim' => '24060122140120',
                'smt' => 3,
                'IPK' => 1.97,
                'IPS_Sebelumnya' => 1.70,
                'telp' => '0829989569409',
                'email' => 'tera@students.com',
                'alamat' => 'Jl. Banjarsari Selatan No. 90, Tembalang, Semarang',
                'status' => '1',
                'prodi' => 'Informatika',
                'dosenwali' => '197505152005012001' 
            ],
            // [
            //     'nama' => 'Farid Rahman',
            //     'nim' => '24060122140199',
            //     'smt' => 5,
            //     'telp' => '082998956999',
            //     'email' => 'farid@students.com',
            //     'alamat' => 'Jl. Banjarsari Selatan No. 100, Tembalang, Semarang',
            //     'prodi' => 'Informatika',
            //     'dosenwali' => '197505152005012001' 
            // ],
            // [
            //     'nama' => 'Mochammad Qaynan Mahdaviqya',
            //     'nim' => '24060122140170',
            //     'smt' => 5,
            //     'telp' => '0829989765409',
            //     'email' => 'qaynan@students.com',
            //     'alamat' => 'Villa Aster 2 N1A, Banyumanik, Semarang',
            //     'prodi' => 'Informatika',
            //     'dosenwali' => '197505152005012001' 
            // ],
            // [
            //     'nama' => 'Dzu Sunan Muhammad',
            //     'nim' => '24060122120034',
            //     'smt' => 5,
            //     'IPK' => 3.75,
            //     'IPS_Sebelumnya' => 3.85,
            //     'telp' => '0829989765111',
            //     'email' => 'dzu@students.com',
            //     'alamat' => 'Jangli, Banyumanik, Semarang',
            //     'status' => '1',
            //     'prodi' => 'Informatika',
            //     'dosenwali' => '197505152005012001' 
            // ],
            [
                'nama' => 'Aurellia Putri Budi',
                'nim' => '24060123140168',
                'smt' => 3,
                'IPK' => 2.35,
                'IPS_Sebelumnya' => 2.10,
                'telp' => '082876569889',
                'email' => 'aurel@students.com',
                'alamat' => 'Jl. Mulawarman, Tembalang, Semarang',
                'status' => '1',
                'prodi' => 'Informatika',
                'dosenwali' => '196303161988101001' // Priyo
            ],
            [
                'nama' => 'Nabila Najma Manika',
                'nim' => '24060123140172',
                'smt' => 4,
                'IPK' => 2.98,
                'IPS_Sebelumnya' => 2.75,
                'telp' => '085899577422',
                'email' => 'nabila@students.com',
                'alamat' => 'Jl. Bulusan Selatan No. 90, Tembalang, Semarang',
                'status' => '1',
                'prodi' => 'Informatika',
                'dosenwali' => '196303161988101001'
            ]
        ];
        DB::table('mahasiswa')->insert($mahasiswa);
    }
}