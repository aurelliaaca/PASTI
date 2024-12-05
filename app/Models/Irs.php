<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irs extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'irs';

    // Primary key
    protected $primaryKey = 'irsid';

    // Menonaktifkan timestamps jika tidak digunakan
    public $timestamps = false;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
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
}
