<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class histori_irs extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'histori_irs';
    public $timestamps = false;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'jadwalid',
        'nim',
        'smt',
        'status_verifikasi',
        'tanggal_disetujui',
    ];

    /**
     * Relasi ke tabel Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal_mata_kuliah::class, 'jadwalid', 'jadwalid');
    }
}