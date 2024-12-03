<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian_akademik extends Model
{
    use HasFactory;

    protected $table = 'bagian_akademik';
    protected $primaryKey = 'nip';
    public $incrementing = false; // Because 'nim' is not auto-incrementing
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'nip',
        'smt',
        'telp',
        'email',
        'alamat',
        'prodi',
    ];
}
