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
            ['namaprodi' => 'Informatika', 'gedung' => 'E', 'namaruang' => 'E101', 'kapasitas' => 50, 'is_plotted' => true, 'status' => 'sudah disetujui'],
            ['namaprodi' => 'Informatika', 'gedung' => 'E', 'namaruang' => 'E102', 'kapasitas' => 60, 'is_plotted' => true, 'status' => 'sudah disetujui'],
            ['namaprodi' => 'Informatika', 'gedung' => 'E', 'namaruang' => 'E103', 'kapasitas' => 70, 'is_plotted' => true, 'status' => 'sudah disetujui'],
            ['namaprodi' => 'Informatika', 'gedung' => 'F', 'namaruang' => 'F201', 'kapasitas' => 80, 'is_plotted' => true, 'status' => 'belum disetujui'],
            ['namaprodi' => 'Informatika', 'gedung' => 'F', 'namaruang' => 'F202', 'kapasitas' => 90, 'is_plotted' => false, 'status' => 'belum disetujui'],
            ['namaprodi' => 'Informatika', 'gedung' => 'F', 'namaruang' => 'F203', 'kapasitas' => 100, 'is_plotted' => false, 'status' => 'belum disetujui'],
            ['namaprodi' => 'Biologi', 'gedung' => 'G', 'namaruang' => 'G301', 'kapasitas' => 110, 'is_plotted' => true, 'status' => 'belum disetujui'],
            ['namaprodi' => 'Biologi', 'gedung' => 'G', 'namaruang' => 'G302', 'kapasitas' => 120, 'is_plotted' => true, 'status' => 'belum disetujui'],
            ['namaprodi' => 'Biologi', 'gedung' => 'G', 'namaruang' => 'G303', 'kapasitas' => 130, 'is_plotted' => true, 'status' => 'sudah disetujui'],
            ['namaprodi' => 'Biologi', 'gedung' => 'H', 'namaruang' => 'H401', 'kapasitas' => 140, 'is_plotted' => true, 'status' => 'belum disetujui'],
            ['namaprodi' => 'Biologi', 'gedung' => 'H', 'namaruang' => 'H402', 'kapasitas' => 150, 'is_plotted' => false, 'status' => 'belum disetujui'],
            ['namaprodi' => 'Biologi', 'gedung' => 'H', 'namaruang' => 'H403', 'kapasitas' => 160, 'is_plotted' => true, 'status' => 'belum disetujui'],
        ];

        foreach ($ruangan as $r) {
            Ruangan::create($r);
        }
    }
}
