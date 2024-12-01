<?php

// file: app/Models/JadwalIrs.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIrs extends Model
{
    use HasFactory;

    protected $table = 'jadwal_irs'; // Nama tabel di database
    protected $primaryKey = 'id'; // Kunci utama
    public $timestamps = false; // Matikan timestamp jika tidak diperlukan

    protected $fillable = [
        'keterangan', 'jadwal_mulai', 'jadwal_berakhir',
    ];
}
