<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan DB facade diimpor

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen = [
            [
                'nama' => 'Dr. Kamaruddin, S.Kom., M.Kom.',
                'nip' => '197505152005012001',
                'telp' => '085655433211',
                'email' => 'kamaruddin@dosen.com',
                'alamat' => 'Graha Estetika No. 75 Tembalang, Semarang'
            ],
            [
                'nama' => 'Azizah Salsabila, S.Kom., M.Kom.',
                'nip' => '198910182005012002',
                'telp' => '089876543066',
                'email' => 'azizah@dosen.com',
                'alamat' => 'Jl. Setia Budi No. 11 Banyumanik, Semarang'
            ],
            [
                'nama' => 'Prof. Dr. Priyo, S.Si., M.T.',
                'nip' => '196303161988101001',
                'telp' => '087665433211',
                'email' => 'priyo@dosen.com',
                'alamat' => 'Jl. Setia Budi No. 88 Banyumanik, Semarang'
            ],
            [
                'nama' => 'Dio Nicolin, S.Si., M.T.',
                'nip' => '198907031988101001',
                'telp' => '082334556778',
                'email' => 'dio@dosen.com',
                'alamat' => 'Jl. Timoho Timur No. 77 Tembalang, Semarang'
            ],
            [
                'nama' => 'Anita Maharani, S.Kom., M.T.',
                'nip' => '198705221234567890',
                'telp' => '089887655433',
                'email' => 'anita@dosen.com',
                'alamat' => 'Jl. Diponegoro No. 97 Gajah Mungkur, Semarang'
            ],
            [
                'nama' => 'Sri Utami, S.Kom., M.Kom.',
                'nip' => '197905121234567891',
                'telp' => '082987564908',
                'email' => 'sri@dosen.com',
                'alamat' => 'Jl. Diponegoro No. 50 Gajah Mungkur, Semarang'
            ],
            [
                'nama' => 'Dr. Lestari Widyanigrum, S.Kom., M.Kom.',
                'nip' => '198111081234567892',
                'telp' => '089267894567',
                'email' => 'lestari@dosen.com',
                'alamat' => 'Jl. Ahmad Yani No. 51 Pedurungan, Semarang'
            ],
            [
                'nama' => 'Rahma Adhani, S.Si., M.T.',
                'nip' => '198507251234567893',
                'telp' => '085689076345',
                'email' => 'rahma@dosen.com',
                'alamat' => 'Jl. Ahmad Yani No. 76 Pedurungan, Semarang'
            ],
            [
                'nama' => 'Dr. Indah Permatasari, S.Si., M.T.',
                'nip' => '199002181234567894',
                'telp' => '087759075632',
                'email' => 'indah@dosen.com',
                'alamat' => 'Jl. Dharmawangsa No. 96 Pedurungan, Semarang'
            ],
            [
                'nama' => 'Dr. Ahmad Fadli, S.Si., M.Kom.',
                'nip' => '198102101234567800',
                'telp' => '085663490846',
                'email' => 'ahmad@dosen.com',
                'alamat' => 'Jl. Mayjend Sungkono No. 19 Candisari, Semarang'
            ],
            // [
            //     'nama' => 'Prof. Bambang Hartono, S.Si., M.Kom.',
            //     'nip' => '197507151234567801',
            //     'telp' => '089063915309',
            //     'email' => 'bambang@dosen.com',
            //     'alamat' => 'Jl. Mayjend Sungkono No. 143 Candisari, Semarang'
            // ],
            // [
            //     'nama' => 'Setiawan Saputra, S.Kom., M.Kom.',
            //     'nip' => '198309221234567802',
            //     'telp' => '081867239076',
            //     'email' => 'setiawan@dosen.com',
            //     'alamat' => 'Jl. Mayjend Sungkono No. 22 Candisari, Semarang'
            // ],
            // [
            //     'nama' => 'Roni Kurniawan, S.Kom., M.Kom.',
            //     'nip' => '198805111234567803',
            //     'telp' => '082230974297',
            //     'email' => 'roni@dosen.com',
            //     'alamat' => 'Jl. HR Muhammad No. 42 Candisari, Semarang'
            // ],
            // [
            //     'nama' => 'Arif Wibowo, S.Kom., M.Kom.',
            //     'nip' => '199001031234567804',
            //     'telp' => '082232538754',
            //     'email' => 'arif@dosen.com',
            //     'alamat' => 'Jl. HR Muhammad No. 80 Candisari, Semarang'
            // ],
            // [
            //     'nama' => 'Rizky Pratama, S.Si., M.Kom.',
            //     'nip' => '198602221234567806',
            //     'telp' => '0855430965836',
            //     'email' => 'rizky@dosen.com',
            //     'alamat' => 'Jl. HR Muhammad No. 27 Candisari, Semarang'
            // ],
            // [
            //     'nama' => 'Aditya Kurniawan, S.Si., M.Kom.',
            //     'nip' => '199103201234567807',
            //     'telp' => '0877640965836',
            //     'email' => 'aditya@dosen.com',
            //     'alamat' => 'Jl. HR Muhammad No. 47 Candisari, Semarang'
            // ],
            // [
            //     'nama' => 'Teguh Prakoso, S.Si., M.Kom.',
            //     'nip' => '198405161234567808',
            //     'telp' => '0877640969823',
            //     'email' => 'teguh@dosen.com',
            //     'alamat' => 'Jl. Gedangan No. 65 Ngaliyan, Semarang'
            // ],
            // [
            //     'nama' => 'Prof. Dimas Surya, S.Si., M.Kom.',
            //     'nip' => '197208141234567809',
            //     'telp' => '081564096982',
            //     'email' => 'dimas@dosen.com',
            //     'alamat' => 'Jl. Gedangan No. 18 Ngaliyan, Semarang'
            // ],
            [
                'nama' => 'Prof. Niken, S.Si., M.Kom.',
                'nip' => '197405161234567808',
                'telp' => '0877640969800',
                'email' => 'niken@dosen.com',
                'alamat' => 'Jl. Gedangan No. 80 Ngaliyan, Semarang'
            ] 
        ];
        DB::table('dosen')->insert($dosen);
    }
}
