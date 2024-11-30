<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $primaryKey = 'ruang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ruang',
        'gedung',
        'prodi',
        'kapasitas',
    ];
}
