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
            [ 'gedung' => 'E', 'namaruang' => 'E101', 'kapasitas' => 80, 'namaprodi' => 'Informatika', 'status' => 'sudah disetujui', 'is_plotted' => true],
            [ 'gedung' => 'E', 'namaruang' => 'E102', 'kapasitas' => 90, 'namaprodi' => 'Informatika', 'status' => 'sudah disetujui', 'is_plotted' => true],
            [ 'gedung' => 'E', 'namaruang' => 'E103', 'kapasitas' => 100, 'namaprodi' => 'Informatika', 'status' => 'sudah disetujui', 'is_plotted' => true],
            [ 'gedung' => 'F', 'namaruang' => 'F201', 'kapasitas' => 110, 'namaprodi' => 'Informatika', 'status' => 'sudah disetujui', 'is_plotted' => true]
        ];

        foreach ($ruangan as $r) {
            Ruangan::create($r);
        }
    }
}