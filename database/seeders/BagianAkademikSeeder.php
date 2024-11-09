<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan DB facade diimpor

class BagianAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bagian_akademik = [
            [
                'nama' => 'Ahlis Dinal, S.Kom., M.Kom.',
                'nip' => '199003092010013001',
                'telp' => '081223445667',
                'email' => 'dinal@bak.com',
                'alamat' => 'Jl. Sirojudin No. 67 Tembalang, Semarang',
                'prodi' => 'Informatika'
            ]
        ];
        DB::table('bagian_akademik')->insert($bagian_akademik);
    }
}
