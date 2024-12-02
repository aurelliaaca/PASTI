<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $primaryKey = 'id'; // Kunci utama

    public $timestamps = false;
    
    protected $fillable = [ //gedungnya diilangin
        'gedung',
        'ruang',
        'kapasitas'
    ];
}
