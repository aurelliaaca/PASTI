<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'kode',
        'sks',
        'status',
        'semester',
    ];

    public function jadwals()
{
    return $this->hasMany(Jadwal_mata_kuliah::class, 'kodemk', 'kode');
}
}