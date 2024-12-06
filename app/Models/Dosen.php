<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    public $incrementing = false; // Because 'nip' is not auto-incrementing
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'nip',
        'telp',
        'email',
        'alamat',
        // 'prodi' //ini aku comment dulu karena mau pake kodeprodi ya
        'kodeprodi' //ini belum aku sambungin sama tabel prodi
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

    // public function prodi()
    // {
    // return $this->belongsTo(Prodi::class, 'kodeprodi'); // memastikan ada hubungan dengan model Prodi
    // }

}