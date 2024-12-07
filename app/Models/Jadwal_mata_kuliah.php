<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal_mata_kuliah extends Model
{
    use HasFactory;
    
    protected $table = 'jadwal_mata_kuliah';
    protected $primaryKey = 'jadwalid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'jadwalid',
        // nambahin kode prodi buat tabel persetujuan jadwal di dekan
        'kodeprodi',
        'kodemk',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang_id',
        'kelas',
        'hari',
        'kodemk',
        'kuota',
        'koordinator_nip',
        'pengampu1_nip',
        'pengampu2_nip',
        'kuota',
        'status'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kodeprodi', 'kodeprodi');
    }

    // Relasi dengan Matkul
    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'kodemk', 'kode');
    }

    //relasi dengan ruang
    public function plottingRuang()
    {
        return $this->belongsTo(PlottingRuang::class, 'ruang_id', 'id');
    }

    //relasi dengan dosen
    public function koordinator()
    {
        return $this->belongsTo(Dosen::class, 'koordinator_nip', 'nip');
    }

    //relasi dengan dosen
    public function pengampu1()
    {
        return $this->belongsTo(Dosen::class, 'pengampu1_nip', 'nip');
    }

    //relasi dengan dosen
    public function pengampu2()
    {
        return $this->belongsTo(Dosen::class, 'pengampu2_nip', 'nip');
    }

    public function irs()
    {
        return $this->hasMany(Irs::class, 'jadwalid', 'jadwalid');
    }
}

