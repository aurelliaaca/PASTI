<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\histori_irs;

class histori_irsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $histori_irs = [
            [   //Semester 1 Pancasila
                'jadwalid' => '38',  
                'nim' => '24060122140168',
                'smt' => '1',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 1 Daspro
                'jadwalid' => '1',
                'nim' => '24060122140168',
                'smt' => '1',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 1 Olahraga
                'jadwalid' => '40',
                'nim' => '24060122140168',
                'smt' => '1',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 1 Dasis
                'jadwalid' => '3',
                'nim' => '24060122140168',
                'smt' => '1',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 1 Logif
                'jadwalid' => '4',
                'nim' => '24060122140168',
                'smt' => '1',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 1 Diskrit
                'jadwalid' => '5',
                'nim' => '24060122140168',
                'smt' => '1',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 1 Inggris
                'jadwalid' => '42',
                'nim' => '24060122140168',
                'smt' => '1',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 1 Mat I
                'jadwalid' => '1',
                'nim' => '24060122140168',
                'smt' => '1',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 2 Indonesia
                'jadwalid' => '39',
                'nim' => '24060122140168',
                'smt' => '2',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 2 Alpro
                'jadwalid' => '7',
                'nim' => '24060122140168',
                'smt' => '2',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 2 Agama
                'jadwalid' => '43',
                'nim' => '24060122140168',
                'smt' => '2',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 2 OAK
                'jadwalid' => '8',
                'nim' => '24060122140168',
                'smt' => '2',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 2 Alin
                'jadwalid' => '9',
                'nim' => '24060122140168',
                'smt' => '2',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 2 Mat II
                'jadwalid' => '6',
                'nim' => '24060122140168',
                'smt' => '2',
                'status_verifikasi' => 'Sudah disetujui'    
            ],
            [   //Semester 2 IOT
                'jadwalid' => '41',
                'nim' => '24060122140168',
                'smt' => '2',
                'status_verifikasi' => 'Sudah disetujui'    
            ],

        ];

        foreach ($histori_irs as $hi) {
            histori_irs::create($hi);
        }
    }
}