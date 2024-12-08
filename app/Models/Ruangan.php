<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    public $timestamps = false;
    
    protected $fillable = [ 
        'namaprodi',
        'gedung',
        'namaruang',
        'kapasitas',
        'status'
    ];   

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'namaprodi');
    }

    public function jadwalMataKuliah()
    {
        return $this->hasMany(Jadwal_mata_kuliah::class, 'namaruang', 'namaruang');
    }
}
