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
            ]
        ];
        DB::table('dosen')->insert($dosen);
    }
}
