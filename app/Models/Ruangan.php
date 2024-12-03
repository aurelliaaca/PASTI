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
        'gedung',
        'ruang',
        'kapasitas'
    ];

    public function plottingRuangs()
    {
        return $this->hasMany(PlottingRuang::class, 'ruangan_id');
    }
}
