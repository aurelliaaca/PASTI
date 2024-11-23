<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RuangKelas extends Model
{
    use HasFactory;

    protected $table = 'ruang_kelas';
    public $timestamps = false;
    
    protected $fillable = [
        'kaprodi',
        'departemen',
        'ruang',
        'kapasitas'
    ];
}