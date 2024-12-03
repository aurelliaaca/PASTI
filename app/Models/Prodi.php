<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'programstudi';
    protected $primaryKey = 'kodeprodi';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;
    protected $fillable = [
        'kodeprodi',
        'namaprodi',
    ];

    public function jadwals()
{
    return $this->hasMany(Jadwal_mata_kuliah::class, 'kodeprodi', 'kodeprodi');
}
}
