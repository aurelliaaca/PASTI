<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'nip',
        'telp',
        'email',
        'alamat',
        'kodeprodi'
    ];

    public function dekan()
    {
        return $this->belongsTo(Dekan::class, 'nip', 'nip');
    }
    public function kaprodi()
    {
        return $this->belongsTo(KetuaProdi::class, 'nip', 'nip');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'dosenwali', 'nip');
    }

    public function jadwalsKoordinator()
    {
        return $this->hasMany(Jadwal_mata_kuliah::class, 'koordinator_nip', 'nip');
    }

    public function jadwalsPengampu1()
    {
        return $this->hasMany(Jadwal_mata_kuliah::class, 'pengampu1_nip', 'nip');
    }

    public function jadwalsPengampu2()
    {
        return $this->hasMany(Jadwal_mata_kuliah::class, 'pengampu2_nip', 'nip');
    }
    // public function prodi()
    // {
    // return $this->belongsTo(Prodi::class, 'kodeprodi'); // memastikan ada hubungan dengan model Prodi
    // }

}