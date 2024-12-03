<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangan = [
            ['gedung' => 'E', 'ruang' => 'E101', 'kapasitas' => 50],
            ['gedung' => 'E', 'ruang' => 'E102', 'kapasitas' => 60],
            ['gedung' => 'E', 'ruang' => 'E103', 'kapasitas' => 70],
            ['gedung' => 'F', 'ruang' => 'F201', 'kapasitas' => 80],
            ['gedung' => 'F', 'ruang' => 'F202', 'kapasitas' => 90],
            ['gedung' => 'F', 'ruang' => 'F203', 'kapasitas' => 100],
            ['gedung' => 'G', 'ruang' => 'G301', 'kapasitas' => 110],
            ['gedung' => 'G', 'ruang' => 'G302', 'kapasitas' => 120],
            ['gedung' => 'G', 'ruang' => 'G303', 'kapasitas' => 130],
            ['gedung' => 'H', 'ruang' => 'H401', 'kapasitas' => 140],
            ['gedung' => 'H', 'ruang' => 'H402', 'kapasitas' => 150],
            ['gedung' => 'H', 'ruang' => 'H403', 'kapasitas' => 160],
        ];

        foreach ($ruangan as $r) {
            Ruangan::create($r);
        }
    }
}
