<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false; // Because 'nim' is not auto-incrementing
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'nim',
        'smt',
        'telp',
        'email',
        'alamat',
        'prodi',
        'status',
        'dosenwali'
    ];

    public function irs()
{
    return $this->hasMany(Irs::class, 'nim', 'nim');
}
}